<?php namespace Acme\Content\Spinner\Facades;

use Illuminate\Support\Facades\Facade;

class Spinner extends Facade {

	/**
	* Get the registered name of the component.
	*
	* @return string
	*/
	protected static function getFacadeAccessor() { return 'spinner'; }

}