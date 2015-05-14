<?php namespace Acme\Indexer\Queues;

use Acme\Indexer\BuildVideoCacheCommand;
use Acme\Interfaces\FireQueueInterface;
use Laracasts\Commander\CommanderTrait;

class QueueRebuildSitemap implements FireQueueInterface {

	use CommanderTrait;

	public function fire($job, $data)
	{
		$project_id = $data['project_id'];

		$obj = new static;

		$obj->execute(BuildVideoCacheCommand::class, ['project_id' => $project_id]);

		$job->delete();
	}
}