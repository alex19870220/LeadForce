<?php

use Acme\Scraper\GoogleScraper;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class ProjectStats extends \Eloquent {

	use EventGenerator, PresentableTrait;

	protected $guarded = [];

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'project_stats';

	/**
	 * @var Presenter $presenter
	 */
	protected $presenter = 'Acme\Presenters\ProjectStatsPresenter';

	/**
	 * The default stats
	 *
	 * @var array $attributes
	 */
	protected $attributes = [
		'index_count'	=> '0',
		'page_count'	=> '0',
		'pagerank'		=> '0',
		'moz'			=> '0',
		'majestic'		=> '0',
		'ahrefs'		=> '0',
		];

	/**
	 * @var array $count
	 */
	protected $count = [];

	/**
	 * @var array $results
	 */
	public $results = [];

	/**
	 * Set last used to transform into Carbin
	 *
	 * @return Carbon
	 */
	public function getDates()
	{
		return ['created_at', 'updated_at'];
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
	 * Relationship with Project
	 *
	 * @return Project
	 */
	public function project()
	{
		return $this->belongsTo('Project', 'project_id', 'id');
	}

	/*
	|--------------------------------------------------------------------------
	| Query Scopes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Today's Stats
	 *
	 * @return Query
	 */
	public function scopeFromToday()
	{
		return $this->where('created_at', '>=', Carbon::today());
	}

	/**
	 * [scopeLatest description]
	 *
	 * @return [type]
	 */
	public function scopeLatest()
	{
		return $this->orderBy('id', 'DESC');
	}

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/


}