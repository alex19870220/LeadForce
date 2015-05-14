<?php namespace Acme\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * Register FatBoy event listeners
	 */
	public function register()
	{
		$this->app['events']->listen('Acme.Projects.Events.*', 'Acme\Projects\Listeners\ProjectListener');	// Projects
		$this->app['events']->listen('Acme.Indexer.Events.*', 'Acme\Indexer\Listeners\TheIndexer');			// Indexer
		$this->app['events']->listen('Acme.Sitemaps.Events.*', 'Acme\Sitemaps\Listeners\Pinger');			// Sitemaps
	}
}