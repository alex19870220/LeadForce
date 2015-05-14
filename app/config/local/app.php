<?php

return [

	'debug' => true,

	'url' => "http://leadforce.loc",

	'key' => 'JGYxHLAQJzu33wKz0FxSbGmllpK9k2V2',

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => [
		/* Additional Providers */
		'Clockwork\Support\Laravel\ClockworkServiceProvider',
	],

	 /*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => [
		/* Additional Aliases */
		// 'Clockwork'       => 'Clockwork\Support\Laravel\Facade',						// Clockwork
	],

];