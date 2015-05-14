<?php namespace Acme\Providers;

use Acme\Monetization\Leadgen\LeadgenFormHelper;
use Illuminate\Support\ServiceProvider;

class LeadgenFormHelperServiceProvider extends ServiceProvider {

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
		// $this->package('pingpong/shortcode');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['leadgenformhelper'] = $this->app->share(function($app)
		{
			return new LeadgenFormHelper;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['leadgenformhelper'];
	}

}