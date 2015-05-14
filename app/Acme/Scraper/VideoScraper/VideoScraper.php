<?php namespace Acme\Scraper\VideoScraper;

use Acme\Scraper\ShutterScraper;
use Acme\Scraper\ShutterRequest;
use Niche;
use Str;

class VideoScraper {

	/**
	 * The Rolling Curl instance
	 *
	 * @var RollingCurl
	 */
	protected $ShutterScraper;

	/**
	 * The YouTube API URLs for scraping videos
	 *
	 * @var string
	 */
	protected $videoUrl = 'http://gdata.youtube.com/feeds/api/videos?q=';

	/**
	 * YouTube API Developer key (not required)
	 *
	 * @var string
	 */
	protected $developerKey = 'AI39si63d8UM0iXeFZmkv5liZbLlOYBnRYbc7X6OrNPH1S9zbYZ7XGBm1D6Ip1MqrTiqLanZRq-wEa-OOlU8NU1cxM6L-3Gmgg';

	/**
	 * Array for YouTube URLs to be scraped
	 *
	 * @var array
	 */
	protected $urls = [];

	/**
	 * Array of query modifiers for searches
	 *
	 * @var array
	 */
	protected $modList = [
		'best','common','diy',
		'greatest','guides','high quality',
		'important','local','most common',
		'most popular','new','professional',
		'special','the worlds top',
		'tutorials','unique','various',
		];

	// protected $modList = [
	// 	'best', 'amazing', 'perfect',
	// 	];

	/**
	 * Array of keywords to search for
	 *
	 * @var array
	 */
	public $keywords = [];

	/**
	 * Array of video ID's to store
	 *
	 * @var array
	 */
	public $videoIds = [];

	/**
	 * Instantiate the object
	 *
	 * @param RollingCurl $ShutterScraper
	 */
	function __construct()
	{
		$ShutterScraper = new ShutterScraper;

		$this->rollingCurl = $ShutterScraper;
	}

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
	 * Initiates the ShutterScraper object and scrapes videos using the keywords supplied
	 *
	 * @param  integer $windowSize
	 * @return array $videoIds
	 */
	public function doScrapeVideos($windowSize = 5)
	{
		// Get Rolling Curl
		$ShutterScraper = $this->rollingCurl;

		$urls = $this->generateUrls();

		// Add urls to queue
		foreach($urls as $url){
			$request = new ShutterRequest($url);

			// Set options
			$request->options = $ShutterScraper->getOptions($request);

			// Set random user agent
			$request->options = $ShutterScraper->newUserAgent($request->options);

			// Set a random proxy
			$request->options = $ShutterScraper->setProxy($request->options);

			$ShutterScraper->add($request);
		}

		// Set the callback function
		$ShutterScraper->setCallback(function(ShutterRequest $request, ShutterScraper $ShutterScraper)
		{
			// echo round((memory_get_usage() / 1024 / 1024), 2) . "MB<br />";
			$this->scraperCallback($request, $ShutterScraper);
		});

		// SCRAPE!
		$ShutterScraper->execute($windowSize);

		// Dedupe!
		$this->videoIds = array_unique($this->videoIds);

		// dd($this->videoIds);

		return $this->videoIds;
	}

	/**
	 * The callback function for the video scraper to run
	 *
	 * @param  ShutterRequest $request
	 * @param  ShutterScraper $rollingcurl
	 * @return array $videoIds
	 */
	protected function scraperCallback(ShutterRequest $request, ShutterScraper $rollingcurl)
	{
		// Parse the XML
		$youtubefeed = simplexml_load_string($request->getResponseText());

		$vids = [];
		$videoIds = $this->videoIds;

		// Loop through each feed item
		foreach($youtubefeed->entry as $entry){
			$vids[] = explode("/", $entry->id);
		}

		// Loop through and grab each video ID
		foreach($vids as $vid){
			// $videoIds[] = $vid[count($vid) - 1];
			$this->videoIds[] = last($vid);
		}
	}

	/**
	 * Generate URLs to scrape
	 *
	 * @return array
	 */
	protected function generateUrls()
	{
		// Video URL array
		$videoUrl = $this->videoUrl;

		// Array for URLs
		$urls	= [];

		$query	= '';

		$keywords = $this->keywords;

		// Check if there is at least one keyword
		if(count($keywords) < 1) return false;

		// Setup dev key
		$devKey = (! is_null($this->developerKey)) ? '&key=' . $this->developerKey : null;

		// Loop keywords
		foreach($keywords as $keyword)
		{
			// Check keyword string length
			if(strlen($keyword) < 4) continue;

			foreach($this->modList as $modword)
			{
				$query = str_replace('-', ' ', Str::slug($modword . ' ' . $keyword));

				$urls[] = $videoUrl . urlencode($query) . $devKey;
			}
		}

		// Update the URLs
		$this->urls = $urls;

		return $urls;
	}

	/*
	|--------------------------------------------------------------------------
	| Static Methods ;)
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Simple static method to scrape videos for the keywords supplied
	 *
	 * @param  Array  $keywords
	 * @return Array
	 */
	public static function scrapeVideos($keywords, $windowSize = 5)
	{
		// Start the object
		$obj = new static;

		// Set the keywords
		$obj->setKeywords($keywords);

		$videoIds = $obj->doScrapeVideos($windowSize);

		return $videoIds;
	}

}