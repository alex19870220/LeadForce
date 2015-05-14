<?php namespace Acme\Scraper\Facades;

use Illuminate\Support\Facades\Facade;

class ShutterProxy extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(){ return 'shutterproxy'; }

}