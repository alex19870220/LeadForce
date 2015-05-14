<?php namespace Acme\Sitemaps\Queues;

use Acme\Sitemaps\RebuildSitemapCommand;
use Acme\Interfaces\FireQueueInterface;
use Laracasts\Commander\CommanderTrait;

class QueueRebuildSitemap implements FireQueueInterface {

	use CommanderTrait;

	public function fire($job, $data)
	{
		$project_id = $data['project_id'];

		$obj = new static;

		$obj->execute(RebuildSitemapCommand::class, ['project_id' => $project_id]);

		$job->delete();
	}
}