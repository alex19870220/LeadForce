<?php

use Acme\Social\Users\FollowableTrait;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class User extends SentryUserModel {

	use FollowableTrait, PresentableTrait, SoftDeletingTrait;

	/**
	 * Soft deleting dates
	 *
	 * @var array
	 */
	protected $dates = [
		'deleted_at',
		'last_login',
		'created_at',
		'updated_at'
		];

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * The Model presenter
	 *
	 * @var string
	 */
	protected $presenter = 'Acme\Presenters\UserPresenter';

	/**
	 * Default options values
	 *
	 * @var options
	 */
	protected $attributes = [
		'options' => [
			// Adsense
			'adsense' => [
				'publisher_id' => null,
			],
			// Indexer API's
			'indexers' => [
				'instantlinkindexer' => [
					'apikey' => null,
				],
				'indexification' => [
					'apikey' => null,
				],
				'linkprocessor' => [
					'apikey' => null,
				],
			],
		],
	];

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Group relationship
	 *
	 * @return Post
	 */
	public function groups()
	{
		return $this->belongsToMany('Group', 'users_groups');
	}

	/**
	 * Post relationship
	 *
	 * @return Post
	 */
	public function posts()
	{
		return $this->hasMany('Post');
	}

	/**
	 * Relationship to Adsense
	 *
	 * @return Adsense
	 */
	public function adsense()
	{
		return $this->hasOne('Adsense');
	}

	/**
	 * Relationship to Project
	 *
	 * @return Project
	 */
	public function projects()
	{
		return $this->hasMany('Project', 'created_by');
	}

	/**
	 * Relationship to Niche
	 *
	 * @return Niche
	 */
	public function niches()
	{
		return $this->hasMany('Niche', 'user_id');
	}

	/**
	 * A user has many followers
	 *
	 * @return mixed
	 */
	// public function followers()
	// {
	// 	return $this->belongsToMany(static::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
	// }

	/**
	 * A user has many statuses.
	 *
	 * @return mixed
	 */
	public function statuses()
	{
		return $this->hasMany('Status')->latest();
	}

	/**
	 * A user has many comments
	 *
	 * @return mixed
	 */
	public function comments()
	{
		return $this->hasMany('Comment');
	}

	/*
	|--------------------------------------------------------------------------
	| Random Shit
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Determine if the given user is the same
	 * as the current one.
	 *
	 * @param  $user
	 * @return bool
	 */
	public function is($user)
	{
		if (is_null($user)) return false;

		return $this->username == $user->username;
	}

	/**
	 * Returns the user full name, it simply concatenates
	 * the user first and last name.
	 *
	 * @return string
	 */
	public function fullname()
	{
		return "{$this->first_name} {$this->last_name}";
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
	 * Options - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getOptionsAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Options - Serialize
	 *
	 * @param Array $value array of options
	 */
	public function setOptionsAttribute(Array $options) {
		$jsonOptions = json_encode($options);
		if($jsonOptions) {
			$this->attributes['options'] = $jsonOptions;
		} else {
			throw new InvalidArgumentException("Unable to convert `options` object to JSON");
		}
	}

	/**
	 * Get option value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getOption($key)
	{
		return object_get($this->options, $key, null);
	}

	/**
	 * Sets an option
	 *
	 * @param string $key
	 * @param string $value
	 */
	public function setOption($key, $value)
	{
		$options = json_decode(json_encode($this->options), true);
		array_set($options, $key, $value);
		$this->options = $options;

		return $this;
	}

	/**
	 * Contact Info - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getContactInfoAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Contact Info - Serialize
	 *
	 * @param Array $value array of contact_info
	 */
	public function setContactInfoAttribute(Array $contact_info) {
		$jsonContactInfo = json_encode($contact_info);
		if($jsonContactInfo) {
			$this->attributes['contact_info'] = $jsonContactInfo;
		} else {
			throw new InvalidArgumentException("Unable to convert `contact_info` object to JSON");
		}
	}

	/**
	 * Get contact_info value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getContactInfo($key)
	{
		return object_get($this->contact_info, $key, null);
	}

	/**
	 * Date mutators for last login
	 *
	 * @return array
	 */
	// public function getDates()
	// {
	// 	return ['created_at', 'updated_at', 'last_login'];
	// }

}