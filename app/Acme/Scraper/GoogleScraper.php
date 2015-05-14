<?php namespace Acme\Scraper;

// Eww dirty... but it works
require_once(__DIR__ . '/Helpers/simple_html_dom.php');

// use Acme\Scraper\ShutterScraper;
// use Acme\Scraper\ShutterRequest;
use Niche;
use Str;

class GoogleScraper {

	/**
	 * The Rolling Curl instance
	 *
	 * @var RollingCurl
	 */
	protected $ShutterScraper;

	/**
	 * @var string $google
	 */
	protected $googleUrls = [
		0	=>'https://www.google.com/search?q=%KW%&sourceid=chrome&espv=210&es_sm=122&ie=UTF-8',
		1	=>'https://www.google.com/search?q=%KW%&ie=utf-8&as_qdr=all&aq=t&rls=org:mozilla:us:official&client=firefox&num=10&filter=1',
		2	=>'https://www.google.com/search?q=%KW%&sourceid=chrome&filter=1&es_sm=122&ie=UTF-8',
		3	=>'https://www.google.com/search?q=%KW%&ie=utf-8&as_qdr=all&aq=t&sourceid=chrome&num=10&filter=1',
		4	=>'https://www.google.com/search?q=%KW%&ie=UTF-8&sourceid=chrome&es_sm=122&filter=1',
		];

	/**
	 * @var array $keywords
	 */
	protected $keywords = [];

	/**
	 * @var array $results
	 */
	protected $results = [];

	/**
	 * Number of scraping attempts to perform
	 *
	 * @var integer
	 */
	protected $attempts = 3;

	/**
	 * Scraping thread count
	 *
	 * @var integer $windowSize
	 */
	protected $windowSize = 5;

	/**
	 * Instantiate the object
	 *
	 * @param RollingCurl $ShutterScraper
	 */
	function __construct()
	{
		$this->ShutterScraper = new ShutterScraper;
	}

	/**
	 * Executes the RollingCurl sequence
	 *
	 * @return array $results
	 */
	private function execute()
	{
		$ShutterScraper = $this->ShutterScraper;

		// Make sure there's requests
		if($ShutterScraper->countPending() < 1)
		{
			return false;
		}

		$results = $this->results;

		// Set the callback function
		$ShutterScraper->setCallback(function(ShutterRequest $request, ShutterScraper $ShutterScraper)
		{
			// Update Proxy stats
			$this->ShutterScraper->updateProxy($request);

			// Check if response was 200 or not
			$responseInfo = $request->getResponseInfo();
			$http_code = (! isset($responseInfo['http_code'])) ? null : $responseInfo['http_code'];

			// Perform callback if http code is 200
			if($http_code == 200 || $http_code == '200')
				$this->curlCallback($request, $ShutterScraper);
		});

		// SCRAPE!
		$ShutterScraper->execute($this->windowSize);

		return $this->results;
	}

	/**
	 * Curl callback that allows processing multiple threads
	 *
	 * @param  ShutterRequest $request
	 * @param  ShutterScraper $rollingcurl
	 * @return null
	 */
	protected function curlCallback(ShutterRequest $request, ShutterScraper $rollingcurl)
	{
		$html = $request->getResponseText();
		$url = $request->getUrl();

		// dd($html);
		$html = str_get_html($html);
		$numResults = $this->numResults($html);
		$serpResults = $this->scrapeSerps($html);

		// Get search query
		if($q = $this->getSearchQuery($url))
		{
			$this->results[] = [
				'query'		=> $q,
				'results'	=> $numResults,
				'serps'		=> $serpResults,
				];
		}
	}

	/**
	 * Static function to scrape an array of keywords, then return results
	 *
	 * @param  array  $urls
	 * @return array
	 */
	public static function scrape($urls){

		$obj = new static;

		// $obj->ShutterScraper;
		$obj->setRequests($urls);
		$obj->execute();

		return $obj->results;

		$results;
	}

	/**
	 * Static function to get the index count of a website
	 *
	 * @param  array  $url
	 * @return array
	 */
	public static function scrapeIndexCount($url, $checks = 1){

		$obj = new static;

		$urls = [];

		// Build the array of URLs being checked multiple times
		for($x = 1;$x <= $checks;$x++)
		{
			$urls[$x] = $url;
		}

		// Flatten array for some reason...
		$urls = array_flatten($urls);

		// $obj->ShutterScraper;
		$obj->setRequests($urls);
		$obj->execute();

		return $obj->results;

		$results;
	}

	/*
	|--------------------------------------------------------------------------
	| Scrape Google
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns an array of the SERP results
	 *
	 * @param  string $html
	 * @return array $results
	 */
	private function scrapeSerps($html = ''){

		// Get SERP links
		$linkObjs = $html->find('h3.r a');

		// Results array
		$results = [];

		for($i = 0;$i < count($linkObjs);$i++) {
			$title = trim($linkObjs[$i]->plaintext);
			$url  = trim($linkObjs[$i]->href);

			// if it is not a direct link but url reference found inside it, then extract
			if (!preg_match('/^https?/', $url) && preg_match('/q=(.+)&amp;sa=/U', $url, $matches) && preg_match('/^https?/', $matches[1])) {
				$url = $matches[1];
			} else if (!preg_match('/^https?/', $url)) { // skip if it is not a valid link
				continue;
			}

			// Parse the URL
			$results[$i]['rank']	= $i + 1;
			$results[$i]['title']	= $title;
			$results[$i]['url']		= $url;
			$results[$i]['host']	= $this->parseDomain($url);
		}

		return $results;
	}

	/**
	 * Get number of results
	 *
	 * @return array()
	 */
	private function numResults($html = null){
		// If $html is empty
		if(! $html)
			return null;

		// Grab results from "that" div :P
		$num_results = $html->find('div#resultStats', 0)->plaintext;
		$num_results = filter_var($num_results, FILTER_SANITIZE_NUMBER_INT);

		// TaDaaaaa!
		return (! is_numeric($num_results)) ? 0 : $num_results;
	}

	/*
	|--------------------------------------------------------------------------
	| Rolling Curl Setup
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Sets all the scraper requests for the keywords provided
	 *
	 * @param mixed $keywords
	 */
	protected function setRequests($urls)
	{
		// Check if array or not
		if(is_array($urls))
		{
			$urls = array_map('strtolower', $urls);
			$urls = array_map('trim', $urls);
		}
		else
		{
			$urls[0] = trim(strtolower($urls));
		}

		$ShutterScraper = $this->ShutterScraper;

		foreach($urls as $url){

			// Get a new request to the URL
			$request = $this->getNewRequest($url);

			$ShutterScraper->add($request);
		}

		return $ShutterScraper;
	}

	/**
	 * Returns a new ShutterRequest for the queue
	 *
	 * @param  string $url
	 * @return ShutterRequest $request
	 */
	protected function getNewRequest($url)
	{
		$ShutterScraper = $this->ShutterScraper;

		$request = new ShutterRequest($this->googleSearch($url));
		// Set options
		$request->options = $ShutterScraper->getOptions($request);
		// Set random user agent
		$request->options = $ShutterScraper->newUserAgent($request->options);
		// Set a random proxy
		$request->options = $ShutterScraper->setProxy($request->options);

		return $request;
	}

	/**
	 * Replaces the keyword in Google's search URL
	 *
	 * @param  string $url
	 * @return string
	 */
	private function googleSearch($url)
	{
		$rand = mt_rand(0, count($this->googleUrls) - 1);
		$googleUrl = $this->googleUrls[$rand];

		return str_replace('%KW%', urlencode($url), $googleUrl);
	}

	/*
	|--------------------------------------------------------------------------
	| Helpers
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns this Object's keywords
	 *
	 * @return array $keywords
	 */
	public function getKeywords()
	{
		return $this->keywords;
	}

	/**
	 * Set the keywords array and flatten it
	 *
	 * @param mixed $keywords
	 */
	public function setKeywords($keywords)
	{
		if( ! is_array($keywords))
		{
			$keywords = explode(',', $keywords);
		}

		// Flatten the array into single column
		$keywords = array_flatten($keywords);
		// Trim & lowercase the array
		$keywords = array_map('trim', $keywords);
		$keywords = array_map('strtolower', $keywords);

		$this->keywords = $keywords;

		return $keywords;
	}

	/**
	 * Parses the URL for the host
	 *
	 * @param  string $url
	 * @return string
	 */
	public function parseDomain($url){
		return str_replace('www.', '', trim(parse_url($url, PHP_URL_HOST)));
	}

	/**
	 * Parses the search query URL from a Google search
	 *
	 * @param  url $url
	 * @return string
	 */
	public function getSearchQuery($url)
	{
		parse_str(parse_url($url, PHP_URL_QUERY), $params);

		return (! isset($params['q'])) ? false : $params['q'];
	}

}