<?php namespace Acme\Repositories;

use Input;
use Project;
use Sentry;

class ProjectRepository {

	/**
	 * @var ProjectOptions $projectOptions
	 */
	protected $projectOptions;

	/**
	 * Instantiate the Object
	 *
	 * @param ProjectOptions $projectOptions
	 */
	function __construct(\Acme\Projects\ProjectOptions $projectOptions)
	{
		$this->projectOptions = $projectOptions;
	}

	/**
	 * Saves a new Project, fires an event, and returns it
	 *
	 * @return Project $project
	 */
	public function storeNewProject()
	{
		$project = new Project;

		$project = $this->setData($project);
		$project->created_by = Sentry::getId();

		// Was the project created?
		if($project->saveNewProject())
			return $project;

		return false;
	}

	/*
	|--------------------------------------------------------------------------
	| Set data
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Sets the Project object's data and returns it
	 *
	 * @param Project $project
	 */
	public function setData(Project $project)
	{
		// Remove the beginning HTTP/WWW
		$website_url = strtolower(str_replace(['http://', 'https://', 'www.', ' '], '', e(Input::get('website_url'))));
		// Separate the domain and TLD
		$website_url_explode = explode('.', $website_url);
		$website_slug = $website_url_explode[0];
		unset($website_url_explode[0]);
		$website_tld = strtolower(implode('.', $website_url_explode));
		// Update the project data
		$project->label				= Input::get('label');
		$project->website_title		= Input::get('website_title');
		$project->website_url		= $website_url;
		$project->slug				= $website_slug;
		$project->tld				= $website_tld;
		$project->template			= e(Input::get('template'));
		$project->about				= e(Input::get('about'));

		// Niche
		if(! is_null(Input::get('niche_id')) && ! empty(Input::get('niche_id')))
			$project->niche_id = Input::get('niche_id');

		// Category
		if(! is_null(Input::get('category_id')) && ! empty(Input::get('category_id')))
			$project->category_id = Input::get('category_id');

		// Sidebar
		if(! is_null(Input::get('sidebar_id')) && ! empty(Input::get('sidebar_id')))
			$project->sidebar_id = Input::get('sidebar_id');

		// Update options
		$options = Input::get('options');

		// Get default options & overwrite with new options
		$project->options = $this->projectOptions->setOptionsTemplate($options);

		// Return the data-filled object
		return $project;
	}
}