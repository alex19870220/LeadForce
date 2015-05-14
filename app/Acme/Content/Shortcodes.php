<?php namespace Acme\Content;

use Route;
use Shortcode;

class Shortcodes {

	protected $content;

	/**
	 * @var Project
	 */
	protected $project;

	/**
	 * @var State
	 */
	protected $state;

	/**
	 * @var City
	 */
	protected $city;

	/**
	 * @var Niche
	 */
	protected $niche;

	/**
	 * Main keyword
	 *
	 * @var keyword_main
	 */
	protected $keyword_main;

	/**
	 * Content keywords
	 *
	 * @var keywords
	 */
	protected $keywords;

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
	 * Registers all Shortcodes
	 *
	 * @return bool
	 */
	private function registerShortcodes()
	{
		// Project shortcodes
		if($this->project !== null)
		{
			Shortcode::register('project', 'Acme\Content\Shortcode\Shortcodes\Project');

			// Keywords
			Shortcode::register('mkw', 'Acme\Content\Shortcode\Shortcodes\Keywords@mkw');
			Shortcode::register('Mkw', 'Acme\Content\Shortcode\Shortcodes\Keywords@mkw');
			Shortcode::register('MKW', 'Acme\Content\Shortcode\Shortcodes\Keywords@mkw');

			Shortcode::register('ckw', 'Acme\Content\Shortcode\Shortcodes\Keywords@ckw');
			Shortcode::register('Ckw', 'Acme\Content\Shortcode\Shortcodes\Keywords@ckw');
			Shortcode::register('CKW', 'Acme\Content\Shortcode\Shortcodes\Keywords@ckw');
		}

		// State shortcodes
		if($this->state !== null)
		{
			$this->content = str_ireplace('[st]', '[st]', $this->content);
			$this->content = str_ireplace('[state]', '[state]', $this->content);

			Shortcode::register('st', 'Acme\Content\Shortcode\Shortcodes\State@st');
			Shortcode::register('state', 'Acme\Content\Shortcode\Shortcodes\State@state');
		}

		// City/Content shortcodes
		if($this->city !== null)
		{
			$this->content = str_ireplace('[city]', '[city]', $this->content);

			Shortcode::register('city', 'Acme\Content\Shortcode\Shortcodes\City@city');
			Shortcode::register('zip', 'Acme\Content\Shortcode\Shortcodes\Zip@zip');
			Shortcode::register('googlemap', 'Acme\Content\Shortcode\Shortcodes\GoogleMap');
			Shortcode::register('header', 'Acme\Content\Shortcode\Shortcodes\Header');
		}

		// Parse the Niche shortcodes
		if($this->niche !== null)
		{

		}

		return true;
	}

	/**
	 * Parses all the shortcodes available with what data is available in the instance
	 *
	 * @return $content
	 */
	protected function parseShortcodes()
	{
		return Shortcode::compile($this->content);
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
		$this->content = $content;

		return $this->parseShortcodes();
	}

}