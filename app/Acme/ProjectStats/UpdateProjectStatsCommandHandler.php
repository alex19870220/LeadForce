<?php namespace Acme\ProjectStats;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use StatsUpdater;

class UpdateProjectStatsCommandHandler {

	use DispatchableTrait;

	/**
	 * Handle the command
	 *
	 * @param  Commander $command
	 * @return boolean
	 */
	public function handle($command)
	{
		$userId = $command->userId;

		$UpdateStats = StatsUpdater::updateAllProjectStats($userId);

		$this->dispatchEventsFor($UpdateStats);

		return $UpdateStats;
	}

}