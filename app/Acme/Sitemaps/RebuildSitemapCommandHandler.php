<?php namespace Acme\Sitemaps;

use Acme\Sitemaps\Helpers\SitemapBuilder;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class RebuildSitemapCommandHandler implements CommandHandler {

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

		$sitemap = SitemapBuilder::rebuild($project_id);

		$this->dispatchEventsFor($sitemap);

		return true;
	}

}