<?php namespace Acme\Presenters;

use Cache;
use Laracasts\Presenter\Presenter;
use Request;
use Route;
use Spinner;
use URL;

class PagePresenter extends Presenter {

	protected $project;

	/**
	 * Constructor
	 *
	 * @param $entity
	 */
	function __construct($entity)
	{
		$this->project =	Route::input('projectSlug');

		parent::__construct($entity);
	}

	/**
	 * Return the route URL of the page
	 *
	 * @return string
	 */
	public function url($projectSlug = null)
	{
		$project =	($projectSlug !== null) ? $projectSlug : $this->project->slug;

		return route('project/page', [$projectSlug, $this->entity->slug]);
	}

}