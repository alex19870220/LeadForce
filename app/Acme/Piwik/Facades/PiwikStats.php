<?php namespace Acme\Piwik\Facades;

use Illuminate\Support\Facades\Facade;

class PiwikStats extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(){ return 'piwikstats'; }

}