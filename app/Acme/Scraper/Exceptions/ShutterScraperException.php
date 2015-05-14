<?php namespace Acme\Scraper\Exceptions;

class ShutterScraperException extends Exception {

	/**
	 * Initialize
	 *
	 * @param string  $message
	 * @param integer $code
	 */
	function __construct($message = "", $code = 0){ // For PHP < 5.3 compatibility omitted: , Exception $previous = null
		ShutterScraper::add_debug_msg($message);
		parent::__construct($message, $code);
	}
}