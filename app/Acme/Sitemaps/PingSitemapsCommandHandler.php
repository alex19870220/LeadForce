<?php namespace Acme\Sitemaps;

use Acme\Indexer\Helpers\VideoSitemapBuilder;
use Acme\Sitemaps\Helpers\SitemapBuilder;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class PingSitemapsCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * Handle the command
	 *
	 * @param  Command $command
	 * @return boolean
	 */
	public function handle($command)
	{
		$project_id = $command->project_id;

		$sitemap = SitemapBuilder::ping($project_id);

		// $this->dispatchEventsFor($sitemap);

		$sitemap = VideoSitemapBuilder::ping($project_id);

		// $this->dispatchEventsFor($sitemap);

		return true;
	}

}