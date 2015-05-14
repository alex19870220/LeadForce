<?php namespace Acme\Indexer;

use Indexer;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateCampaignCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * Handle the command
	 *
	 * @param  Commander $command
	 * @return boolean
	 */
	public function handle($command)
	{
		$campaign = Indexer::post($command->project_id);

		$this->dispatchEventsFor($campaign);

		return true;
	}

}