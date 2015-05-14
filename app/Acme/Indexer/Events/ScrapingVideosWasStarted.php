<?php namespace Acme\Indexer\Events;

class ScrapingVideosWasStarted {

	public $campaign_id;

	function __construct($campaign_id)
	{
		$this->campaign_id = $campaign_id;
	}

}