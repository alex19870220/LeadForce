<?php

class Error404 extends \Eloquent {

	protected $fillable = [];

	/**
	 * The database table used by this model
	 * @var string
	 */
	protected $table = '404_errors';

	/**
	 * Default attributes
	 *
	 * @var array $attributes
	 */
	protected $attributes = [
		'hits'	=> 1,
	];

	/**
	 * Relationship to Niche
	 *
	 * @return relationship
	 */
	public function project()
	{
		return $this->belongsTo('Project', 'project_id');
	}
}