<?php namespace Acme\Images\Facades;

use Illuminate\Support\Facades\Facade;

class ImageHelper extends Facade {

	/**
	* Get the registered name of the component.
	*
	* @return string
	*/
	protected static function getFacadeAccessor() { return 'imagehelper'; }

}