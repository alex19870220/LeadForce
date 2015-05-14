<?php namespace Acme\Indexer\Helpers;

use Cache;
use City;
use Config;
use Niche;
use Page;
use Project;
use State;

class PageLister {

	/**
	 * @var Project $project
	 */
	protected $project;

	/**
	 * Instantiate the Object
	 *
	 * @param integer $projectId
	 */
	function __construct($projectId = null)
	{
		if(! is_null($projectId))
			$this->setProject($projectId);
	}

	/*
	|--------------------------------------------------------------------------
	| PageLister Usage
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Sets the Project
	 *
	 * @param integer $projectId
	 */
	public function setProject($projectId)
	{
		$this->project = Project::find($projectId)->firstOrFail();

		return $this;
	}

	/*
	|--------------------------------------------------------------------------
	| URL Grabbers
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Grab all State + City models & return them
	 *
	 * @return State
	 */
	public function grabStates()
	{
		$states = State::remember(Config::get('acme.cache.geo'))
			->orderBy('state')
			->get();

		$urlList = [];

		foreach($states as $state)
		{
			$urlList[] = $state->present()->url($this->project->slug, $this->project->tld);
		}

		// dd($states);

		return $urlList;
	}

	/**
	 * Grab all Cities in a list
	 *
	 * @return array $list
	 */
	public function grabCitiesList()
	{
		$states = $this->grabStates();
		$project = $this->project;

		// Loop each City
		foreach($cities as $city)
		{
			$key = $key . "city:{$city->id}:";

			// $list[$city->id] = $city->present()->url($project->slug, $state->abbr);
		}

		return $list;
	}

	public static function getPages($projectId)
	{
		$obj = new static;

		return true;
	}

	/**
	 * Static function to grab all project URLs
	 *
	 * @param  int $projectId
	 * @return array $list
	 */
	public static function grabAllUrls($projectId)
	{
		$obj = new static($projectId);

		// Grab Project & its Niches
		$project = $obj->project;

		// Grab Pages list
		$pageList = $obj->grabPagesList();

		// Grab Niche page list
		$grabNichePagesList = $obj->grabNichePagesList();

		dd($grabNichePagesList);

		// Grab Cities list
		// $cityList = $obj->grabCitiesList();

		return $list;
	}

	/**
	 * Grab all State URLs
	 *
	 * @return array $list
	 */
	public function grabNichePagesList()
	{
		ini_set('memory_limit','512M');

		$states = $this->grabStates();
		$project = $this->project;
		$niches = $this->niches;

		// dd($niches->first());

		// $key = "p:{$this->project->id}:state:{$state->id}:city:{$city->id}:niche:{$niche->id}"
		// $key = $this->key;

		$list = [];

		// Loop each State & set: $state->id => URL
		foreach($states as $state)
		{
			$stateKey = $this->key . "state:{$state->id}";

			// Add State to list
			$list[$stateKey] = $state->present()->url($project->slug, $project->tld);

			$cities = $state->cities()->get();

			// Loop each City
			foreach($cities as $city)
			{
				$cityKey = $stateKey . ":city:{$city->id}";

				// Add City to list
				$list[$cityKey] = $city->present()->url($project->slug, $project->tld, $state->abbr);

				// Loop each Niche
				foreach($niches as $niche)
				{
					$nicheKey = $cityKey . ":niche:{$niche->id}";

					$list[$nicheKey] = $niche->present()->url($project->slug, $project->tld, $state->abbr, $city->slug);

				} // End Niche


			} // End City

		} // End State

		dd($list);

		return $list;
	}

	/**
	 * Grab all page URLs
	 *
	 * @return array $list
	 */
	public function grabPagesList()
	{
		if(! $this->project) return false;

		$project = $this->project;

		$key = $this->key . 'pages';

		$pages = Cache::remember($key, 30, function() use ($project)
			{
				return Page::where('projectId', $project->id)->whereActive(true)->orderBy('title', 'ASC')->get();
			});

		$list = [];

		// Loop each page & set: $page->id => URL
		foreach($pages as $page)
		{
			$list[$page->id] = $page->present()->url($project->slug, $project->tld);
		}

		return $list;
	}

}