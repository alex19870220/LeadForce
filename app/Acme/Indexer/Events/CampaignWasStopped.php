<?php namespace Acme\Indexer\Events;

use Indexer;

class CampaignWasStopped {

	public $campaign;

	/**
	 * Instantiate the object
	 *
	 * @param Indexer $campaign
	 */
	function __construct(Indexer $campaign) /* or pass in just the relevant fields */
	{
		$this->campaign = $campaign;
		// dd('Campaign was stopped!');
	}

}