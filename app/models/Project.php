<?php

use Acme\Projects\Events\ProjectWasCreated;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class Project extends \Eloquent {

	use EventGenerator, PresentableTrait, SoftDeletingTrait;

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
	protected $presenter = 'Acme\Presenters\ProjectPresenter';

	/**
	 * Saves a new Project and fires an Event
	 *
	 * @return mixed
	 */
	public function saveNewProject()
	{
		if($this->save())
		{
			$this->raise(new ProjectWasCreated($this));

			return $this;
		}

		return false; //failed
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
	 * Relationship with ProjectCategory
	 *
	 * @return ProjectCategory
	 */
	public function category()
	{
		return $this->belongsTo('ProjectCategory', 'category_id', 'id');
	}

	/**
	 * Relationship with Niche
	 *
	 * @return Niche
	 */
	public function niche()
	{
		return $this->belongsTo('Niche', 'niche_id', 'id');
	}

	/**
	 * Relation with Page
	 *
	 * @return Page
	 */
	public function pages()
	{
		return $this->hasMany('Page', 'project_id');
	}

	/**
	 * Relation with Indexer
	 *
	 * @return Indexer
	 */
	public function indexer()
	{
		return $this->hasOne('Indexer', 'project_id');
	}

	/**
	 * Returns the Project's main Niche object
	 *
	 * @return Niche
	 */
	public function getNiche()
	{
		return $this->niche()->first();
	}

	/**
	 * Returns the Project's ProjectStats
	 *
	 * @return ProjectStats
	 */
	public function stats()
	{
		return $this->hasMany('ProjectStats', 'project_id', 'id');
	}

	/**
	 * Returns the Project's OptinForms
	 *
	 * @return OptinForms
	 */
	public function forms()
	{
		return $this->belongsToMany('OptinForms', 'optin_form_project');
	}

	/**
	 * Returns the Project's Sidebar
	 *
	 * @return Sidebar
	 */
	public function sidebar()
	{
		return $this->belongsTo('Sidebar', 'sidebar_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Checks if the Project has any errors, returns true if it does
	 *
	 * @return boolean
	 */
	public function hasErrors()
	{
		if($this->error_content == true)
			return true;

		return false;
	}

	/**
	 * Page title separator default
	 *
	 * @return string
	 */
	public function titleSeparator()
	{
		return ($this->option['separator'] !== null) ? $this->option['separator'] : '|';
	}

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Get data into array for the frontend
	 *
	 * @param  int $id Project ID
	 * @return array	 all data for the project
	 */
	public static function getData($id)
	{
		return static::find($id);
	}

	/*
	|-------------------------------
	| Options
	|-------------------------------
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
		if(object_get($this->options, $key))
		{
			array_set($this->options, $key, $value);
			// $this->options[$key] = $value;
		} else {
			throw new InvalidArgumentException("The option [$key] does not exist.");
		}
		return $this;
	}

	/*
	|-------------------------------
	| Content
	|-------------------------------
	|
	*/

	/**
	 * Get content value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getContent($key)
	{
		return object_get($this->content, $key, null);
	}

	/**
	 * Get content attribute from database
	 *
	 * @param  json $value
	 * @return stdClass
	 */
	public function getContentAttribute($value)
	{
		return json_decode($value);
	}

	/**
	 * Content - Serialize
	 *
	 * @param Array $value array of content
	 */
	public function setContentAttribute(Array $content) {
		$jsonContent = json_encode($content);
		if($jsonContent) {
			$this->attributes['content'] = $jsonContent;
		} else {
			throw new InvalidArgumentException("Unable to convert `content` object to JSON");
		}
	}

}