<?php namespace Acme\Content\Facades;

use Illuminate\Support\Facades\Facade;

class CacheTags extends Facade {

	/**
	* Get the registered name of the component.
	*
	* @return string
	*/
	protected static function getFacadeAccessor() { return 'cachetags'; }

}