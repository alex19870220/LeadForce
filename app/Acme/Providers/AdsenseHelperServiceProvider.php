<?php namespace Acme\Providers;

use Acme\Monetization\Adsense\AdsenseHelper;
use Illuminate\Support\ServiceProvider;

class AdsenseHelperServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// $this->package('pingpong/adsensehelper');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['adsensehelper'] = $this->app->share(function($app)
		{
			return new AdsenseHelper;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['adsensehelper'];
	}

}