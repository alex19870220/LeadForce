<?php

class Country extends \Eloquent {
	protected $fillable = [];

	/**
	 * The database table used by this model
	 * @var string
	 */
	protected $table = 'geo_countries';

	public $timestamps = false;

	/**
	 * Return the cities that belong to this state
	 *
	 * @return array
	 */
	public function states()
	{
		return $this->hasMany('State');
	}
}