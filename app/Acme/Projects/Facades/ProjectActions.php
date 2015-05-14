<?php namespace Acme\Projects\Facades;

use Illuminate\Support\Facades\Facade;

class ProjectActions extends Facade {

	/**
	* Get the registered name of the component.
	*
	* @return string
	*/
	protected static function getFacadeAccessor() { return 'projectactions'; }

}