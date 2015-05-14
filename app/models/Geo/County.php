<?php

class County extends \Eloquent {

	protected $fillable = [];

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'geo_counties';

	public $timestamps = false;

	/**
	 * Return the State this County belongs to
	 *
	 * @return State
	 */
	public function state()
	{
		return $this->belongsTo('State');
	}

	/**
	 * Return all Cities under this County
	 *
	 * @return City
	 */
	public function cities()
	{
		return $this->hasMany('City', 'county_id');
	}
}