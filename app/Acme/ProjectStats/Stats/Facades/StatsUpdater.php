<?php namespace Acme\ProjectStats\Stats\Facades;

use Illuminate\Support\Facades\Facade;

class StatsUpdater extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(){ return 'statsupdater'; }

}