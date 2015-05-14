<?php namespace Acme\Monetization\EmailOptins;

use Illuminate\Support\ServiceProvider;

class EmailOptinServiceProvider extends ServiceProvider {

	/**
	 * Register binding in IoC container
	 */
	public function register()
	{
		$this->app->bind(
			'Acme\Monetization\EmailOptins\EmailOptin',
			'Acme\Monetization\EmailOptins\Services\MailchimpService'
		);
	}

}