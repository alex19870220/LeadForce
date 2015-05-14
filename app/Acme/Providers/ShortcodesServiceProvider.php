<?php namespace Acme\Providers;

use Illuminate\Support\ServiceProvider;

class ShortcodesServiceProvider extends ServiceProvider {

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
		$this->app['shortcodes'] = $this->app->share(function($app)
		{
			return new \Acme\Content\Shortcode\Shortcodes;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['shortcodes'];
	}
}