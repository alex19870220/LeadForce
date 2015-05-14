<?php namespace Acme\Monetization\Adsense\Facades;

use Illuminate\Support\Facades\Facade;

class AdsenseHelper extends Facade {

	/**
	* Get the registered name of the component.
	*
	* @return string
	*/
	protected static function getFacadeAccessor() { return 'adsensehelper'; }

}