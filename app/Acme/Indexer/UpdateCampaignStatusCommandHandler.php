<?php namespace Acme\Indexer;

use Indexer;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateCampaignStatusCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * Handle the command
	 *
	 * @param  Command $command
	 * @return boolean
	 */
	public function handle($command)
	{
		$campaign_id = $command->campaign_id;

		$campaign = Indexer::updateStatus($campaign_id);

		$this->dispatchEventsFor($campaign);

		return true;
	}

}