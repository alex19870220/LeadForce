<?php namespace Acme\Presenters;

use Cache;
use ContentHandler;
use Laracasts\Presenter\Presenter;
use File;
use Request;
use Route;
use Spinner;
use URL;

class StatePresenter extends Presenter {

	/**
	 * @var Project $project
	 */
	protected $project;

	/**
	 * @var string $stateContent
	 */
	protected $stateContent = '/spintax/content-state.txt';

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
	 * Return State Abbr uppercased
	 *
	 * @return string
	 */
	public function abbr()
	{
		return strtoupper($this->entity->abbr);
	}

	/**
	 * Creates a URL to the State
	 *
	 * @return string
	 */
	public function url($projectSlug = null, $projectTld = null)
	{
		if(! is_null($projectSlug) && ! is_null($projectTld))
			return route('project/state', [$projectSlug, $projectTld, $this->entity->abbr]);

		return route('project/state', [$this->project->slug, $this->project->tld, $this->entity->abbr]);
	}

	/**
	 * Creates a URL to the State / City Letter
	 *
	 * @return string
	 */
	public function urlCityLetter($cityLetter, $projectSlug = null, $projectTld = null)
	{
		if(! is_null($projectSlug) && ! is_null($projectTld))
			return route('project/state/letter', [$projectSlug, $projectTld, $this->entity->abbr, $cityLetter]);

		return route('project/state/letter', [$this->project->slug, $this->project->tld, $this->entity->abbr, $cityLetter]);
	}

	/**
	 * Creates a URL to the State-City Letter view
	 *
	 * @return string
	 */
	public function urlLetter($letter = 'A')
	{
		$project =	$this->project->slug;
		$state = $this->entity->abbr;

		return route('project/state/letter', [$project, $state, $letter]);
	}

	/**
	 * Returns the page title formatted for the site
	 *
	 * @return string
	 */
	public function pageTitle()
	{
		$project = $this->project;

		return "{$project->niche->keyword_main} in {$this->entity->state}";
	}

	/*
	|--------------------------------------------------------------------------
	| Content
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Returns the cached content for this State
	 *
	 * @return string
	 */
	public function content()
	{
		$content = $this->getStateContent();
		$cacheKey = $this->entity->cacheKey($this->project->id, 'stateContent');

		return ContentHandler::processCacheKeyContent($content, $cacheKey);
	}

	/**
	 * Gets the State content from the Project, if empty it uses the generic version
	 *
	 * @return string
	 */
	public function getStateContent()
	{
		if(! empty($this->project->getContent('state')))
		{
			return $this->project->getContent('state');
		}

		$filePath = storage_path() . $this->stateContent;

		if(! isset($filePath) || ! File::exists($filePath))
			return '<span class="text-danger">State content file does not exist!</span>';

		return File::get($filePath);
	}

}