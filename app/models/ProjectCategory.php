<?php

use Laracasts\Presenter\PresentableTrait;

class ProjectCategory extends \Eloquent {

	use PresentableTrait;

	/**
	 * @var array $fillable
	 */
	protected $fillable = [];

	/**
	 * @var string $presenter
	 */
	protected $presenter = 'Acme\Presenters\ProjectCategoryPresenter';

	/**
	 * @var bool $timestamps
	 */
	public $timestamps = false;

	/**
	 * The database table used by this model
	 * @var string
	 */
	protected $table = 'project_categories';

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Relationship to Projects
	 *
	 * @return Project
	 */
	public function projects()
	{
		return $this->hasMany('Project', 'category_id');
	}

	/**
	 * Relationship to Users
	 *
	 * @return User
	 */
	public function user()
	{
		return $this->hasOne('User', 'id', 'owner_id');
	}

}