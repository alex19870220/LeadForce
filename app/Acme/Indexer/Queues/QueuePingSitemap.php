<?php namespace Acme\Indexer\Queues;

use Acme\Indexer\Helpers\VideoSitemapBuilder;
use Acme\Interfaces\FireQueueInterface;

class QueuePingSitemap implements FireQueueInterface {

	public function fire($job, $data)
	{
		$project_id = $data['project_id'];

		$obj = new static;

		$ping = VideoSitemapBuilder::ping($project_id);

		$job->delete();
	}
}