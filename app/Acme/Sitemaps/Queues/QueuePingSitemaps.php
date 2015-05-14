<?php namespace Acme\Sitemaps\Queues;

use Acme\Interfaces\FireQueueInterface;
use Acme\Sitemaps\PingSitemapsCommand;
use Laracasts\Commander\CommanderTrait;

class QueuePingSitemaps implements FireQueueInterface {

	use CommanderTrait;

	public function fire($job, $data)
	{
		$project_id = $data['project_id'];

		$obj = new static;

		$obj->execute(PingSitemapsCommand::class, ['project_id' => $project_id]);

		$job->delete();
	}
}