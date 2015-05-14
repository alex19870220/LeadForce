<?php namespace Acme\Sitemaps\Listeners;

use Acme\Sitemaps\Events\SitemapWasRebuilt;
use Acme\Sitemaps\Helpers\SitemapBuilder;
use Acme\Sitemaps\PingSitemapsCommand;
use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\Events\EventListener;

class Pinger extends EventListener {

	use CommanderTrait;

	/**
	 * When a sitemap is rebuilt, ping it!
	 *
	 * @param  SitemapWasRebuilt $event
	 * @return null
	 */
	public function whenSitemapWasRebuilt(SitemapWasRebuilt $event)
	{
		$this->execute(PingSitemapsCommand::class, ['project_id' => $event->project_id]);
	}
}