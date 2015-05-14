<?php namespace Acme\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('ProjectRepository', function($app)
		{
			return new \Acme\Projects\ProjectRepository;
		});
	}

}