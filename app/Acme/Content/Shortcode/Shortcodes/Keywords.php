<?php namespace Acme\Content\Shortcode\Shortcodes;

use Route;

class Keywords {

	/**
	 * @var Project
	 */
	protected $project;

	/**
	 * @var Niche
	 */
	protected $niche;

	/**
	 * Main keyword
	 */
	protected $keyword_main;

	/**
	 * @var  array $keywords
	 */
	protected $keywords;

	/**
	 * @var  string $ckwLowerCase
	 */
	protected $ckwLowerCase;

	/**
	 * @var  string $ckwSentenceCase
	 */
	protected $ckwSentenceCase;

	/**
	 * @var  string $ckwProperCase
	 */
	protected $ckwProperCase;

	/**
	 * Construct the Shortcode object
	 */
	function __construct()
	{
		$this->project	= Route::input('projectSlug');
		$this->niche	= Route::input('nicheSlug');

		// Main keyword
		$this->keyword_main = $this->getMainKeyword();

		// Content keywords
		$this->keywords = $this->getContentKeywords();
	}

	/**
	 * Gets the main keyword
	 *
	 * @return string
	 */
	protected function getMainKeyword()
	{
		if($this->niche)
			return strtolower($this->niche->keyword_main);

		return strtolower($this->project->niche->keyword_main);
	}

	/**
	 * Gets the main keyword
	 *
	 * @return string
	 */
	protected function getContentKeywords()
	{
		if($this->niche)
			return $this->niche->keywords;

		return $this->project->niche->keywords;
	}

	/*
	|--------------------------------------------------------------------------
	| Main Keyword
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Main Keyword - lowercase
	 *
	 * @param  string $attr
	 * @param  string $content
	 * @param  string $name
	 * @return string
	 */
	public function mkw($attr, $content = null, $name = null)
	{
		if($name == 'Mkw')
			return ucfirst($this->keyword_main);

		if($name == 'MKW')
			return ucwords($this->keyword_main);

		return strtolower($this->keyword_main);
	}

	/*
	|--------------------------------------------------------------------------
	| Content Keywords
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Content Keywords - Lower Case
	 *
	 * @return string
	 */
	public function getCkwLowerCase($attr, $content = null, $name = null)
	{
		return '{' . implode('|', $this->keywords) . '}';
	}

	/**
	 * Content Keywords - Sentence Case
	 *
	 * @return string
	 */
	public function getCkwSentenceCase($attr, $content = null, $name = null)
	{
		return '{' . implode('|', array_map('ucfirst', $this->keywords)) . '}';
	}

	/**
	 * Content Keywords - Proper Case
	 *
	 * @return string
	 */
	public function getCkwProperCase($attr, $content = null, $name = null)
	{
		return '{' . implode('|', array_map('ucwords', $this->keywords)) . '}';
	}

}