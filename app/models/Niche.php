<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Niche extends \Eloquent {

	use SoftDeletingTrait, PresentableTrait;

	/**
	 * Mutate dates
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;

	/**
	 * Mass assignment protection
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * Model presenter
	 *
	 * @var string
	 */
	protected $presenter = 'Acme\Presenters\NichePresenter';

	/**
	 * @var array $attributes
	 */
	protected $attributes = [
		'meta' => [
			'default' => [
				'title'			=> '',
				'description'	=> '',
			],
			'state' => [
				'title'			=> '',
				'description'	=> '',
			],
			'city' => [
				'title'			=> '',
				'description'	=> '',
			],
		],
	];

	/*
	|--------------------------------------------------------------------------
	| Cache Key
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Return cache tag for the niche
	 *
	 * @param  $project_id
	 * @param  $type
	 * @return string $tag
	 */
	public function cacheTag($type = 'contentTag')
	{
		$key = "n:{$this->id}";
		if($type !== null)
			$key = "{$type}|" . $key;

		return $key;
	}

	/**
	 * Return cache key for the niche
	 *
	 * @param  $project_id
	 * @param  $state_id
	 * @param  $city_id
	 * @param  $type
	 * @return string $key
	 */
	public function cacheKey($project_id, $state_id, $city_id, $type = null)
	{
		$key = "p:{$project_id}:s:{$state_id}:c:{$city_id}:n:{$this->id}";
		if($type !== null) $key = "{$type}|" . $key;

		return $key;
	}

	/*
	|--------------------------------------------------------------------------
	| Relationshits
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Return the projects that belong to this niche
	 *
	 * @return Project
	 */
	public function project()
	{
		return $this->hasOne('Project', 'niche_id');
	}

	/**
	 * Returns the Niche parent
	 *
	 * @return Niche
	 */
	public function parent()
	{
		return $this->belongsTo('Niche', 'parent_id');
	}

	/**
	 * Returns the Niche's children
	 *
	 * @return Niche
	 */
	public function children()
	{
		return $this->hasMany('Niche', 'parent_id');
	}

	/**
	 * Relationship to Videos
	 *
	 * @return Video
	 */
	public function videos()
	{
		return $this->hasMany('Video', 'niche_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Returns a family tree or something
	 *
	 * @return ?
	 */
	public function tree()
	{
		return static::with(implode('.', array_fill(0, 100, 'children')))->where_parent_id(0)->get();
	}

	/**
	 * Returns true or false depending on whether this Niche has children
	 *
	 * @return boolean
	 */
	public function hasChildren()
	{
		return ($this->children()->count('id') > 0) ? true : false;
	}

	/**
	 * Return true if the current niche is a parent
	 *
	 * @return boolean
	 */
	public function isParent()
	{
		return ($this->parent_id !== NULL) ? false : true;
	}

	/**
	 * Returns all niches and puts them into an array
	 *
	 * @return array object
	 */
	public static function listNiches()
	{
		return static::orderBy('label', 'ASC')->get();
	}

	/**
	 * Return all Niche parents
	 *
	 * @return Niche
	 */
	public static function listParents()
	{
		return static::whereNull('parent_id')->orderBy('created_at', 'ASC');
	}

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	*/

	/*
	|----------------------------------
	| Keywords
	|----------------------------------
	|
	*/

	/**
	 * Get keywords
	 *
	 * @param  json $value
	 * @return stdClass
	 */
	public function getKeywordsAttribute($value)
	{
		return json_decode($value);
	}

	/**
	 * Save keywords
	 *
	 * @param string $value
	 */
	public function setKeywordsAttribute($value)
	{
		if(! is_array($value))
			$value = explode(',', $value);

		$value = array_map('strtolower', $value);
		$value = array_map('trim', $value);
		// DeDupe
		$value = array_values(array_unique($value));

		$jsonKeywords = json_encode($value);
		if($jsonKeywords) {
			$this->attributes['keywords'] = $jsonKeywords;
		} else {
			throw new InvalidArgumentException("Unable to convert keywords object to JSON");
		}
	}

	/*
	|----------------------------------
	| Metas
	|----------------------------------
	|
	*/

	/**
	 * Meta - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getMetaAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Meta - Serialize
	 *
	 * @param Array $value array of meta
	 */
	public function setMetaAttribute(Array $meta) {
		// Check all the meta sections
		foreach($meta as $metaKey => $metaData)
		{
			if(! in_array($metaKey, ['default', 'state', 'city']) || ! is_array($metaData))
				unset($meta[$metaKey]);
		}

		$jsonMeta = json_encode($meta);
		if($jsonMeta) {
			$this->attributes['meta'] = $jsonMeta;
		} else {
			throw new InvalidArgumentException("Unable to convert `meta` object to JSON");
		}
	}

	/**
	 * Get meta value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getMetaTitle($type)
	{
		if(! in_array($type, ['default', 'state', 'city']))
			throw new InvalidArgumentException("The meta type must be valid!");

		return object_get($this->meta, $type . '.title', null);
	}

	/**
	 * Get meta value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getMetaDescription($type)
	{
		if(! in_array($type, ['default', 'state', 'city']))
			throw new InvalidArgumentException("The meta type must be valid!");

		return object_get($this->meta, $type . '.description', null);
	}

	/**
	 * Sets an meta
	 *
	 * @param string $key
	 * @param string $value
	 */
	public function setMeta($type, $key, $value)
	{
		if(! in_array($type, ['default', 'state', 'city']))
			throw new InvalidArgumentException("The meta type must be valid!");

		$key = "{$type}.{$key}";

		if(object_get($this->meta, $key))
		{
			array_set($this->meta, $key, $value);
			// $this->meta[$key] = $value;
		} else {
			throw new InvalidArgumentException("The meta [{$type}.{$key}] does not exist.");
		}
		return $this;
	}

	/*
	|----------------------------------
	| Stats
	|----------------------------------
	|
	*/

	/**
	 * Stats - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getStatsAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Stats - Serialize
	 *
	 * @param Array $value array of stats
	 */
	public function setStatsAttribute($stats) {
		if(is_null($stats))
		{
			$this->attributes['stats'] = null;
		}
		elseif(is_array($stats))
		{
			$jsonStats = json_encode($stats);
			if($jsonStats) {
				$this->attributes['stats'] = $jsonStats;
			} else {
				throw new InvalidArgumentException("Unable to convert `stats` object to JSON");
			}
		}
	}

	/**
	 * Get stats value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getStats($key)
	{
		return number_format(object_get($this->stats, $key, null));
	}

}