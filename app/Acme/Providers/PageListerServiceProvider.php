<?php namespace Acme\Providers;

use Acme\Indexer\Helpers\PageLister;
use Illuminate\Support\ServiceProvider;

class PageListerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['pagelister'] = $this->app->share(function($app)
		{
			return new PageLister();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['pagelister'];
	}

}