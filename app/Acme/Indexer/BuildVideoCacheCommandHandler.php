<?php namespace Acme\Indexer;

use Acme\Indexer\Helpers\VideoCacheKeyBuilder;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class BuildVideoCacheCommandHandler {

	use DispatchableTrait;

	/**
	 * Handle the command
	 *
	 * @param  Commander $command
	 * @return boolean
	 */
	public function handle($command)
	{
		$project_id = $command->project_id;

		$VideoCacheKeyBuilder = VideoCacheKeyBuilder::setVideoCacheKeys($project_id);

		$this->dispatchEventsFor($VideoCacheKeyBuilder);

		return true;
	}

}