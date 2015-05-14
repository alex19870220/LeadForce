<?php namespace Acme\Indexer;

class ScrapeVideosCommand {

	/**
	 * @var integer  $campaign_id
	 */
	public $campaign_id;

	/**
	 * Instantiate the object
	 *
	 * @param integer $campaign_id
	 */
	function __construct($campaign_id)
	{
		$this->campaign_id = $campaign_id;
	}

}