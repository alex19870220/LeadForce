<?php namespace Acme\Content\Shortcode\Shortcodes;

use Route;

class Project {

	/**
	 * Project data to replace in the content
	 * @var Object
	 */
	protected $project;

	/**
	 * Construct the Shortcode object
	 */
	function __construct()
	{
		$this->project	= Route::input('projectSlug');
	}

	public function register($attr, $content = null, $name = null)
	{

	}
}