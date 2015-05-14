<?php namespace Acme\Content\Shortcode\Shortcodes;

use Route;

class City {

	/**
	 * @var City
	 */
	protected $city;

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		$this->city	= Route::input('city');
	}

	/**
	 * State abbreviation
	 *
	 * @param  string $attr
	 * @param  string $content
	 * @param  string $name
	 * @return string
	 */
	public function city($attr, $content = null, $name = null)
	{
		return $this->city->city;
	}

}