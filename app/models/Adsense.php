<?php

use Laracasts\Presenter\PresentableTrait;

class Adsense extends \Eloquent {

	use PresentableTrait;

	/**
	 * Mass assignment protection
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'adsense';

	/**
	 * Model presenter
	 *
	 * @var string
	 */
	protected $presenter = 'Acme\Presenters\AdsensePresenter';

	/*
	|--------------------------------------------------------------------------
	| Relationshits
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Relationship with User
	 *
	 * @return Project
	 */
	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Data - Ads
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Ads - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getAdsAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Ads - Serialize
	 *
	 * @param Array $value array of ads
	 */
	public function setAdsAttribute(Array $ads) {
		$jsonAds = json_encode($ads);
		if($jsonAds) {
			$this->attributes['ads'] = $jsonAds;
		} else {
			throw new InvalidArgumentException("Unable to convert `ads` object to JSON");
		}
	}

	/**
	 * Get ad value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getAd($key)
	{
		return object_get($this->ads, $key, null);
	}

	/**
	 * Sets an ad
	 *
	 * @param string $key
	 * @param string $value
	 */
	public function setAd($key, $value)
	{
		if(object_get($this->ads, $key))
		{
			array_set($this->ads, $key, $value);
			// $this->ads[$key] = $value;
		} else {
			throw new InvalidArgumentException("The ad [$key] does not exist.");
		}
		return $this;
	}

}