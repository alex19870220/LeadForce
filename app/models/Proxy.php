<?php

use Laracasts\Presenter\PresentableTrait;

class Proxy extends \Eloquent {

	use PresentableTrait;

	/**
	 * @var array $fillable
	 */
	protected $fillable = [];

	/**
	 * @var string $presenter
	 */
	protected $presenter = 'Acme\Presenters\ProxyPresenter';

	/**
	 * @var bool $timestamps
	 */
	public $timestamps = false;

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'proxies';

	/**
	 * Set last used to transform into Carbin
	 *
	 * @return Carbon
	 */
	public function getDates()
	{
		return ['last_used'];
	}

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * This Proxy's relationship to User
	 *
	 * @return User
	 */
	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Job Functions
	|--------------------------------------------------------------------------
	|
	|
	|
	*/



	/*
	|--------------------------------------------------------------------------
	| Query Scopes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Query Scope for active Indexers
	 *
	 * @param  Eloquent $query
	 * @return $query
	 */
	public function scopeActive($query)
	{
		return $query->whereActive(true);
	}

	/**
	 * Query Scope for getting active Indexers
	 *
	 * @param  Eloquent $query
	 * @return $query
	 */
	public function scopeProxyOnly($query)
	{
		return $query->select(['ip', 'port', 'username', 'password']);
	}

	/**
	 * Query Scope for returning Proxies that aren't on timeout
	 *
	 * @param  $query
	 * @param  integer $timeout
	 * @return $query
	 */
	public function scopeTimeout($query, $timeout = 60)
	{
		return $query->where('last_used', '<', date('Y-m-d H:i:s', time() - $timeout));
	}

}