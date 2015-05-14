<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Page extends \Eloquent {

	use SoftDeletingTrait, PresentableTrait;

	protected $fillable = [];

	protected $dates = ['deleted_at'];

	protected $presenter = 'Acme\Presenters\PagePresenter';

	/**
	 * The database table used by this model
	 * @var string
	 */
	protected $table = 'pages';

	/**
	 * Default options values
	 * @var options
	 */
	protected $attributes = [
		'active'		=> true,
		'page_order'	=> 0,
		'layout'		=> 'content_sidebar',
		];

	/*
	|--------------------------------------------------------------------------
	| Cache Key
	|--------------------------------------------------------------------------
	*/

	/**
	 * Return cache key for the page
	 *
	 * @param  $project_id
	 * @param  $type
	 * @return string $key
	 */
	public function cacheKey($project_id, $type = null)
	{
		$key = "p:{$project_id}:p:{$this->id}";
		if($type !== null) $key = "{$type}|" . $key;

		return $key;
	}

	/*
	|--------------------------------------------------------------------------
	| Relationshits
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Page's relationship to Project
	 * @return Project
	 */
	public function project()
	{
		return $this->belongsTo('Project', 'project_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	// public function getMenuLabelAttribute($value) {
	// 	return ucwords($value);
	// }

}