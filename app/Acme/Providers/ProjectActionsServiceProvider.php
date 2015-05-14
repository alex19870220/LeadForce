<?php namespace Acme\Providers;

use Acme\Projects\ProjectActions;
use Illuminate\Support\ServiceProvider;

class ProjectActionsServiceProvider extends ServiceProvider {

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
		$this->app['projectactions'] = $this->app->share(function($app)
		{
			return new ProjectActions;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('projectactions');
	}

}