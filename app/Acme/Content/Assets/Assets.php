<?php namespace Acme\Content\Assets;

use Config;

class Assets {

	/**
	 * @var array $javascripts
	 */
	protected $javascripts = [
		'header'	=> [
		],
		'footer'	=> [
		],
	];

	/**
	 * @var array $stylesheets
	 */
	protected $stylesheets = [];

	/**
	 * Add Javascript
	 *
	 * @param string $url
	 * @param string $location
	 */
	public function addJs($url, $location = 'header')
	{
		if($location !== 'header' && $location !== 'footer')
			$location = 'header';

		$this->javascripts[$location][] = $url;
	}

	/**
	 * Add CSS Stylesheet
	 *
	 * @param string $url
	 */
	public function addCss($url)
	{
		$this->stylesheets[] = $url;
	}

	/*
	|--------------------------------------------------------------------------
	| Output the Scripts
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Outputs the compiled Javascript file
	 *
	 * @param  string $location
	 * @return string
	 */
	public function outputJs($location = 'header')
	{
		if($location !== 'header' && $location !== 'footer')
			$location = 'header';
	}

	/**
	 * Outputs the compiled Stylesheet file
	 *
	 * @return string
	 */
	public function outputCss()
	{
		//
	}

	/**
	 * Outputs the HTML for a Javascript
	 *
	 * @param  string $url
	 * @return string
	 */
	public function outputJsCode($url = null)
	{
		if(is_null($url))
			return false;

		return '<script type="text/javascript" src="' . $url . '">';
	}

	/**
	 * Outputs HTML for jQuery
	 *
	 * @return string
	 */
	public function jQuery()
	{
		return $this->outputJsCode(Config::get('acme.dir.js.jquery'));
	}

	/*
	|--------------------------------------------------------------------------
	| Caching
	|--------------------------------------------------------------------------
	|
	|
	*/

}