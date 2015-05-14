<?php namespace Acme\Providers;

use Acme\Images\ImageHelper;
use Illuminate\Support\ServiceProvider;

class ImageHelperServiceProvider extends ServiceProvider {

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
		// $this->package('pingpong/imagehelper');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['imagehelper'] = $this->app->share(function($app)
		{
			return new ImageHelper;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['imagehelper'];
	}

}