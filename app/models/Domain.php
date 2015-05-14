<?php

class Domain extends \Eloquent {

	protected $fillable = [];

	/**
	 * Return the domain's owner
	 *
	 * @return User
	 */
	public function owner()
	{
		return $this->belongsTo('User', 'user_id');
	}
}