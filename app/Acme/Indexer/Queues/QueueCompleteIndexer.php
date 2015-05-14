<?php namespace Acme\Indexer\Queues;

use Acme\Indexer\BuildVideoCacheCommand;
use Acme\Indexer\ScrapeVideosCommand;
use Acme\Indexer\UpdateCampaignStatusCommand;
use Acme\Interfaces\FireQueueInterface;
use Laracasts\Commander\CommanderTrait;

class QueueCompleteIndexer implements FireQueueInterface {

	use CommanderTrait;

	public function fire($job, $data)
	{
		$campaign_id = $data['campaign_id'];
		$project_id = $data['project_id'];

		$obj = new static;

		# 1. Scrape the videos for each Niche
		$obj->execute(ScrapeVideosCommand::class, ['campaign_id' => $campaign_id]);

		# 2. Cache video/pages and generate sitemap
		$obj->execute(BuildVideoCacheCommand::class, ['project_id' => $project_id]);

		# 3. Set the Indexer to inactive
		$obj->execute(UpdateCampaignStatusCommand::class, ['campaign_id' => $campaign_id]);

		// Send notification to user

		$job->delete();
	}
}