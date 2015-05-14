<?php namespace Acme\Scraper;

class TestTheScrapers {

	/**
	 * Testing the scraper
	 * @return void
	 */
	public function getTestVideoScraper()
	{
		$VideoScraper = new VideoScraper;

		$keywords = [
			'wedding photography',
			'fashion photography',
			];

		$VideoScraper->setKeywords($keywords);

		$videoIds = $VideoScraper->scrapeVideos(3);

		dd($videoIds);

		$IndexerVideo = IndexerVideo::where('campaign_id', '=', '');
	}

	/**
	 * Testing the scraper
	 * @return void
	 */
	public function getTestScraper()
	{
		// Create the object
		$rollingcurl = new ShutterScraper();

		// Initiate the console
		$rollingcurl->init_console();

		$urls = [
			'http://www.google.com',
			'http://www.stocks-to-watch.com',
			'http://www.yahoo.com',
			'http://www.poseidonwebstudios.com',
			'http://mcilwainphotography.com'
		];

		// Add each keyword request
		foreach($urls as $url){

			$request = new ShutterRequest($url);

			// Set options
			$request->options = $rollingcurl->getOptions($request);

			// Set random proxy
			// $request->options = $rollingcurl->proxy($request->options);

			// Set random user agent
			$request->options = $rollingcurl->newUserAgent($request->options);

			$rollingcurl->add($request);
		}

		$rollingcurl
			->setCallback(function(ShutterRequest $request, ShutterScraper $rollingcurl) {
				// parsing html with regex is evil (http://bit.ly/3x9sQX), but this is just a demo
				if (preg_match("#<title>(.*)</title>#i", $request->getResponseText(), $out)) {
					$title = $out[1];
				}
				else {
					$title = '[No Title Tag Found]';
				}
				echo "Fetch complete for (" . $request->getUrl() . ") $title " . PHP_EOL;
				// echo '<pre>'.print_r($request->getResponseInfo()).'</pre>' . PHP_EOL . PHP_EOL;
			});

		// SCRAPE!
		$rollingcurl->execute(5);
	}
}
