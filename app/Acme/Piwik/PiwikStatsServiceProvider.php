<?php namespace Acme\Piwik;

use Illuminate\Support\ServiceProvider;

class PiwikStatsServiceProvider extends ServiceProvider {

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
		$this->app['piwikstats'] = $this->app->share(function()
		{
			return new PiwikStats;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('piwikstats');
	}

}