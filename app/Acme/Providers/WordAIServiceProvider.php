<?php namespace Acme\Providers;

use Illuminate\Support\ServiceProvider;

class WordAIServiceProvider extends ServiceProvider {

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
		$this->app->bind('WordAI', function($app)
		{
			return new \Acme\Articles\WordAI\WordAI;
		});
	}

}