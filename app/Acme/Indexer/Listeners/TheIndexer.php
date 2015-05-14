<?php namespace Acme\Indexer\Listeners;

use Acme\Indexer\Events\CampaignWasStarted;
use Acme\Indexer\Events\CampaignWasStopped;
use Indexer;
use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\Events\EventListener;
use Queue;
use Video;

class TheIndexer extends EventListener {

	use CommanderTrait;

	/**
	 * Start & process the Indexer Campaign
	 *
	 * @param  CampaignWasStarted $event
	 * @return boolean
	 */
	public function whenCampaignWasStarted(CampaignWasStarted $event)
	{
		// dd('Campaign event HANDLER was started!');
	}

	/**
	 * Stop an Indexer Campaign
	 *
	 * @param  CampaignWasStopped $event
	 * @return boolean
	 */
	public function whenCampaignWasStopped(CampaignWasStopped $event)
	{
		// Ping the sitemaps!
		Queue::push('Acme\Sitemaps\Queues\QueuePingSitemaps', ['project_id' => $event->campaign->project_id]);

		// dd('Campaign event HANDLER was stopped!');
	}
}