<?php

use Laracasts\Presenter\PresentableTrait;

class City extends \Eloquent {

	use PresentableTrait;

	protected $fillable = [];

	protected $presenter = 'Acme\Presenters\CityPresenter';

	public $timestamps = false;

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'geo_cities';

	/*
	|--------------------------------------------------------------------------
	| Cache Key
	|--------------------------------------------------------------------------
	*/

	/**
	 * Return cache key for the page
	 *
	 * @param  integer $project_id
	 * @param  integer $state_id
	 * @param  string $type
	 * @return string
	 */
	public function cacheKey($project_id, $state_id, $type = null)
	{
		$key = "p:{$project_id}:s:{$state_id}:c:{$this->id}";

		if($type !== null)
			$key = "{$type}|" . $key;

		return $key;
	}

	/*
	|--------------------------------------------------------------------------
	| Relationshits
	|--------------------------------------------------------------------------
	*/

	/**
	 * Return the state this city belongs to
	 *
	 * @return array
	 */
	public function state()
	{
		return $this->belongsTo('State');
	}

	/**
	 * Relationship with County
	 *
	 * @return County
	 */
	public function county()
	{
		return $this->belongsTo('County', 'county_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	*/

	/**
	 * Returns all postal codes for the City
	 *
	 * @return array
	 */
	public function getPostalCodesAttribute($value)
	{
		return unserialize($value);
	}

}