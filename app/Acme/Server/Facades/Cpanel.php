<?php namespace Acme\Server\Facades;

use Illuminate\Support\Facades\Facade;

class Cpanel extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'cpanel'; }

}