<?php namespace Acme\Monetization\Adsense;

use Adsense;
use Config;
use Str;
use View;

class AdsenseHelper {

	/**
	 * @var array $adSizes;
	 */
	protected $adSizes = [];

	/**
	 * @var string $publisherId
	 */
	protected $publisherId;

	/**
	 * @var array $adUnits
	 */
	protected $adUnits = [];

	/**
	 * Ad count for content Ads
	 *
	 * @var integer $adCount
	 */
	protected $adCount = 0;

	/**
	 * @var string $adView
	 */
	protected $adView = 'frontend.partials.adsense.displayadsense';

	/**
	 * Instantiate the Object
	 */
	function __construct()
	{
		$this->adSizes = Config::get('adsense.adSizes');
	}

	/**
	 * Grabs the ads and data for a project
	 *
	 * @param  integer $adsenseId
	 * @return AdsenseHelper $this
	 */
	public function getAdData($adsenseId)
	{
		$adsense = Adsense::cacheTags('projects')
			->remember(Config::get('acme.cache.adsense'))
			->find($adsenseId);

		if(! $adsense)
			return false;

		$this->publisherId = $adsense->publisher_id;
		$this->adUnits = $adsense->ads;

		return $this;
	}

	/**
	 * Returns the publisher ID
	 *
	 * @return string
	 */
	public function getPublisherId()
	{
		return $this->publisherId;
	}

	/*
	|--------------------------------------------------------------------------
	| Ad Display
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	public function showAd($type, $location, $size = 'default')
	{
		$adType = $this->getAdType($type);
		$adUnit = $this->adUnits[$type];

		// Make sure we're using an ad
		if(! isset($adUnit) || $adUnit == false)
			return false;

		return json_decode(json_encode([
			'adUnitId'	=> $adUnit,
			'width'		=> $adType->w,
			'height'	=> $adType->h,
		]));
	}

	/**
	 * Returns the Adsense view with the ad unit
	 *
	 * @param  stdClass $adUnit
	 * @return View
	 */
	public function getView($adUnit, $size)
	{
		if(! View::exists($this->adView))
			return false;

		$adUnit->size = $size;

		return View::make($this->adView, ['adUnit' => $adUnit])->render();
	}

	/*
	|--------------------------------------------------------------------------
	| Ads by Section
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns the header ad
	 *
	 * @param  string $size
	 * @return View
	 */
	public function getHeaderAd($size = 'default')
	{
		$adUnit = $this->getAdUnit('medium-rectangle');

		// Check the ad unit
		if(! isset($adUnit) || $adUnit === false)
			return false;

		$adUnit->location = 'header';

		return $this->getView($adUnit, $size);
	}

	/**
	 * Gets the top content ad
	 *
	 * @param  string $size
	 * @return View
	 */
	public function getTopContentAd($size = 'default')
	{
		$adUnit = $this->getAdUnit('medium-rectangle');

		// Check the ad unit
		if(! isset($adUnit) || $adUnit === false)
			return false;

		$adUnit->location = 'top-content';

		return $this->getView($adUnit, $size);
	}

	public function setMidContentAds($content, $size = 'default', $number_ads = 1)
	{
		// Checks the #, sets to 1 if invalid
		$this->adCount = (is_int($number_ads) && $number_ads > 0 && $number_ads <= 3) ? $number_ads : 1;

	}

	/**
	 * Gets the footer ad
	 *
	 * @param  string $size
	 * @return View
	 */
	public function getFooterAd($size = 'default')
	{
		$adUnit = $this->getAdUnit('leaderboard');

		// Check the ad unit
		if(! isset($adUnit) || $adUnit === false)
			return false;

		$adUnit->location = 'footer';

		return $this->getView($adUnit, $size);
	}

	/*
	|--------------------------------------------------------------------------
	| Ad Types & Units
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns an ad unit by slug
	 *
	 * @param  string $unit
	 * @return stdClass
	 */
	public function getAdUnit($unit)
	{
		$adType = $this->getAdType($unit);
		$adUnit = object_get($this->adUnits, $unit, null);

		// Make sure we're using an ad
		if(is_null($adUnit) || $adType === false)
			return null;

		return json_decode(json_encode([
			'adUnitId'	=> $adUnit,
			'width'		=> $adType->w,
			'height'	=> $adType->h,
			'location'	=> '',
			]));
	}

	/**
	 * Returns a list of all ad sizes + width/height
	 *
	 * @return stdClass
	 */
	public function getAdTypes()
	{
		$array = $this->adSizes;

		$array = array_sort($array, function($value)
		{
			return $value['w'];
		});

		return json_decode(json_encode($array));
	}

	/**
	 * Returns an ad size + width/height
	 *
	 * @return stdClass
	 */
	public function getAdType($type = '')
	{
		if(! isset($this->adSizes[$type]))
			return false;

		return json_decode(json_encode($this->adSizes[$type]));
	}

}