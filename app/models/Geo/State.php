<?php

use Laracasts\Presenter\PresentableTrait;

class State extends \Eloquent {

	use PresentableTrait;

	protected $fillable = [];

	protected $presenter = 'Acme\Presenters\StatePresenter';

	public $timestamps = false;

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'geo_states';

	/*
	|--------------------------------------------------------------------------
	| Cache Key
	|--------------------------------------------------------------------------
	*/

	/**
	 * Return cache key for the page
	 *
	 * @param  integer $project_id
	 * @param  string $type
	 * @return string
	 */
	public function cacheKey($project_id, $type = null)
	{
		$key = "p:{$project_id}:s:{$this->id}";

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
	 * Return the country this state belongs to
	 *
	 * @return object
	 */
	public function country()
	{
		return $this->belongsTo('Country');
	}

	/**
	 * Return the cities that belong to this state
	 *
	 * @return array
	 */
	public function cities()
	{
		return $this->hasMany('City', 'state_id');
	}

	/**
	 * Return the cities that belong to this state
	 *
	 * @return array
	 */
	public function counties()
	{
		return $this->hasMany('County', 'state_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns State Abbr as lowercase
	 *
	 * @param  string $value
	 * @return string
	 */
	public function getAbbrAttribute($value)
	{
		return strtolower($value);
	}

}