<?php namespace Acme\Content\Shortcode\Shortcodes;

use Route;

class Zip {

	/**
	 * @var City $city
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
	public function zip($attr, $content = null, $name = null)
	{
		if($this->city)
			return $this->city->present()->postalCodes;

		return false;
	}
}