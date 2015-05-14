<?php namespace Acme\Indexer\Queues;

use Acme\Indexer\ScrapeVideosCommand;
use Acme\Interfaces\FireQueueInterface;
use Laracasts\Commander\CommanderTrait;

class QueueVideoScraper implements FireQueueInterface {

	use CommanderTrait;

	public function fire($job, $data)
	{
		$campaign_id = $data['campaign_id'];

		$obj = new static;

		$obj->execute(ScrapeVideosCommand::class, ['campaign_id' => $campaign_id]);

		$job->delete();
	}
}