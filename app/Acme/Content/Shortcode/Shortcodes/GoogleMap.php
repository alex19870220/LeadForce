<?php namespace Acme\Content\Shortcode\Shortcodes;

use Route;

class GoogleMap {

	/**
	 * @var State
	 */
	protected $state;

	/**
	 * @var City
	 */
	protected $city;

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		$this->state	= Route::input('st');
		$this->city		= Route::input('city');
	}

	/**
	 * Display a Google Maps iframe with a few options
	 *
	 * @param  string $attr
	 * @param  string $content
	 * @param  string $name
	 * @return string
	 */
	public function register($attr, $content = null, $name = null)
	{
		$align = array_get($attr, 'align', 'left');
		$width = array_get($attr, 'width', '250');

		// $text = Shortcode::compile($content);

		$output = '<div class="pull-left text-center m-r m-b">';

		if($align == 'left')
		{
			$output = '<div class="pull-left text-center m-r m-b">';
		}
		elseif($align == 'right')
		{
			$output = '<div class="pull-right text-center m-l m-b">';
		}

		$output .= '<iframe width="' . $width . '" scrolling="no" height="200" frameborder="0" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=' . $this->city->city . ' ' . $this->state->state . '&amp;ie=UTF8&amp;z=12&amp;t=m&amp;iwloc=near&amp;output=embed"></iframe><br/>';
		$output .= '<a href="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=' . $this->city->city . ' ' . $this->state->state . '&amp;ie=UTF8&amp;z=12&amp;t=m&amp;iwloc=near" target="_blank">View Larger Map</a>';
		$output .= '</div>';

		return $output;
	}
}