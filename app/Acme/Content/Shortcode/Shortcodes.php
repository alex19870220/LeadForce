<?php namespace Acme\Content\Shortcode;

use Route;
use Shortcode;

class Shortcodes {

	/**
	 * @var $content
	 */
	protected $content;

	/**
	 * @var Project $project
	 */
	protected $project;

	/**
	 * @var State $state
	 */
	protected $state;

	/**
	 * @var City $city
	 */
	protected $city;

	/**
	 * @var Niche $niche
	 */
	protected $niche;

	/**
	 * Construct the Shortcode object
	 */
	function __construct()
	{
		$this->project	= Route::input('projectSlug');
		$this->state	= Route::input('st');
		$this->city		= Route::input('city');
		$this->niche	= Route::input('nicheSlug');

		// Register the Shortcodes
		$this->registerShortcodes();
	}

	/**
	 * Register all Shortcodes
	 *
	 * @return bool
	 */
	private function registerShortcodes()
	{
		// Project shortcodes
		if($this->project !== null)
		{
			// Shortcode::register('project', 'Acme\Content\Shortcode\Shortcodes\Project');

			// Keywords
			Shortcode::register('mkw', 'Acme\Content\Shortcode\Shortcodes\Keywords@mkw');
			Shortcode::register('Mkw', 'Acme\Content\Shortcode\Shortcodes\Keywords@mkw');
			Shortcode::register('MKW', 'Acme\Content\Shortcode\Shortcodes\Keywords@mkw');

			Shortcode::register('ckw', 'Acme\Content\Shortcode\Shortcodes\Keywords@getCkwLowerCase');
			Shortcode::register('Ckw', 'Acme\Content\Shortcode\Shortcodes\Keywords@getCkwSentenceCase');
			Shortcode::register('CKW', 'Acme\Content\Shortcode\Shortcodes\Keywords@getCkwProperCase');
		}

		// State shortcodes
		if($this->state !== null)
		{
			Shortcode::register('st', 'Acme\Content\Shortcode\Shortcodes\State@st');
			Shortcode::register('state', 'Acme\Content\Shortcode\Shortcodes\State@state');
		}

		// City/Content shortcodes
		if($this->city !== null)
		{
			Shortcode::register('city', 'Acme\Content\Shortcode\Shortcodes\City@city');
			Shortcode::register('zip', 'Acme\Content\Shortcode\Shortcodes\Zip@zip');
			Shortcode::register('googlemap', 'Acme\Content\Shortcode\Shortcodes\GoogleMap');
			Shortcode::register('header', 'Acme\Content\Shortcode\Shortcodes\Header');
		}

		// Parse the Niche shortcodes
		if($this->niche !== null)
		{

		}

		Shortcode::register('ul', 'Acme\Content\Shortcode\Shortcodes\UnOrderedList@ul');
		Shortcode::register('li', 'Acme\Content\Shortcode\Shortcodes\UnOrderedList@li');

		return true;
	}

	/**
	 * Parses all the shortcodes available with what data is available in the instance
	 *
	 * @return $content
	 */
	protected function parseShortcodes($content)
	{
		return Shortcode::compile($content);
	}

	/*
	|--------------------------------------------------------------------------
	| Static Functions
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * The static function to process content
	 *
	 * @param $content
	 * @return $content
	 */
	public function process($content)
	{
		return $this->parseShortcodes($content);
	}

}