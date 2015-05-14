<?php namespace Acme\Presenters;

use Laracasts\Presenter\Presenter;
use Route;
use Spinner;
use URL;

class CityPresenter extends Presenter {

	/**
	 * @var Project $project
	 */
	protected $project;

	/**
	 * @var State $state
	 */
	public $state;

	/**
	 * Constructor
	 *
	 * @param $entity
	 */
	function __construct($entity)
	{
		$this->project =	Route::input('projectSlug');
		$this->state =		Route::input('st');

		if(is_null($this->state))
			$this->state = Route::input('stateSlug');

		parent::__construct($entity);
	}

	/*
	|--------------------------------------------------------------------------
	| URL's to Shit
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Creates a URL to the City
	 *
	 * @return string
	 */
	public function url($projectSlug = null, $projectTld = null, $state = null)
	{
		if(! is_null($projectSlug) && ! is_null($projectTld) && ! is_null($state))
			return route('project/city', [$projectSlug, $projectTld, $state, $this->entity->slug]);

		return route('project/city', [$this->project->slug, $this->project->tld, $this->state->abbr, $this->entity->slug]);
	}

	/*
	|--------------------------------------------------------------------------
	| Data Output
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Return spintax of all postal codes for the City
	 *
	 * @return string
	 */
	public function postalCodes()
	{
		return array_spin($this->entity->postal_codes);
	}

}