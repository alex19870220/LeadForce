<?php namespace Acme\Content\Shortcode\Shortcodes;

use Route;

class State {

	/**
	 * @var State
	 */
	protected $state;

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		$this->state	= Route::input('st');
	}

	/**
	 * State abbreviation
	 *
	 * @param  string $attr
	 * @param  string $content
	 * @param  string $name
	 * @return string
	 */
	public function st($attr, $content = null, $name = null)
	{
		return $this->state->present()->abbr;
	}

	/**
	 * State name
	 *
	 * @param  string $attr
	 * @param  string $content
	 * @param  string $name
	 * @return string
	 */
	public function state($attr, $content = null, $name = null)
	{
		return $this->state->state;
	}
}