<?php namespace Acme\Indexer;

use Acme\Indexer\Helpers\YoutubeVideoScraper;
use Acme\Scraper\VideoScraper\VideoScraper;
use Flash;
use Indexer;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Niche;
use Project;
use Redirect;
use Video;

class ScrapeVideosCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * Handle the command
	 *
	 * @param  Commander $command
	 * @return boolean
	 */
	public function handle($command)
	{
		$campaign_id = $command->campaign_id;

		$videoScrape = YoutubeVideoScraper::scrapeVideos($campaign_id);

		$this->dispatchEventsFor($videoScrape);

		return $videoScrape;
	}

}