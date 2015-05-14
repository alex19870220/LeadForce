<?php namespace Acme\Scraper\VideoScraper

use Acme\Scraper\ShutterScraper;
use Acme\Scraper\ShutterRequest;

// Create the object
$rollingcurl = new ShutterScraper();

// Initiate the console
$rollingcurl->init_console();

$urls = [
	'http://www.google.com',
];

// Add each keyword request
foreach($urls as $url){

	$request = new ShutterRequest($url);

	// Set options
	$request->options = $rollingcurl->getOptions($request);
	// Set random user agent
	$request->options = $rollingcurl->newUserAgent($request->options);
	// Add request to que
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