<?php namespace Acme\ProjectStats\Queues;

use Acme\Interfaces\FireQueueInterface;
use Acme\ProjectStats\UpdateProjectStatsCommand;
use Laracasts\Commander\CommanderTrait;

class QueueUpdateStats implements FireQueueInterface {

	use CommanderTrait;

	public function fire($job, $data)
	{
		$userId = $data['userId'];

		$obj = new static;

		$obj->execute(UpdateProjectStatsCommand::class, ['userId' => $userId]);

		$job->delete();
	}
}