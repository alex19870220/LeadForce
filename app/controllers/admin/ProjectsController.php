<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\ProjectForm;
use Acme\Piwik\PiwikSiteFunctions;
use Acme\Projects\Commands\CreateNewProjectCommand;
use Acme\Projects\ProjectOptions;
use Acme\Repositories\ProjectRepository;
use Laracasts\Commander\CommanderTrait;

class ProjectsController extends AdminController {

	use CommanderTrait;

	/**
	 * @var ProjectForm $projectForm
	 */
	protected $projectForm;

	/**
	 * @var ProjectOptions $projectOptions
	 */
	protected $projectOptions;

	/**
	 * @var ProjectRepository $projectRepository
	 */
	protected $projectRepository;

	/**
	 * Instantiate the object
	 *
	 * @param ProjectForm    $projectForm
	 * @param ProjectOptions $projectOptions
	 */
	function __construct(ProjectForm $projectForm, ProjectOptions $projectOptions, ProjectRepository $projectRepository)
	{
		$this->projectForm = $projectForm;
		$this->projectOptions = $projectOptions;
		$this->projectRepository = $projectRepository;

		// Niche list for forms
		$allNiches = Niche::listParents()->get(['id', 'label']);

		// Email Optins
		$emailOptins = OptinForm::orderBy('label', 'ASC')->lists('label', 'id');

		// Sidebars
		$allSidebars = Sidebar::orderBy('label', 'ASC')->get(['id', 'label']);

		// Adsense Groups
		$adsenseGroups = Adsense::where('user_id', '=', Sentry::getUser()->id)->orderBy('label', 'ASC')->get(['id', 'label']);

		// Project Categories
		$allCategories = ProjectCategory::where('owner_id', '=', Sentry::getUser()->id)->orderBy('label')->get(['id', 'label']);

		// Sharing is caring
		View::share('allNiches', $allNiches);
		View::share('emailOptins', $emailOptins);
		View::share('allSidebars', $allSidebars);
		View::share('adsenseGroups', $adsenseGroups);
		View::share('allCategories', $allCategories);

		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * GET /$COLLECTION$
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$projects = $this->getProjects();

		return View::make('backend.projects.dashboard', compact('projects'));
	}

	/**
	 * Grabs all Projects for the Projects table
	 *
	 * @return Project
	 */
	public function getProjects()
	{
		$projects = Project::with([
			'niche' => function($q) {
				$q->select('id', 'keyword_main', 'keywords', 'excerpt', 'content', 'stats');
			},
			'niche.children' => function($q) {
				$q->select('id', 'parent_id', 'keyword_main', 'keywords', 'excerpt', 'content', 'stats');
			},
			'stats' => function($q) {
				$q->orderBy('id', 'DESC');
				// $q->groupBy('project_id'); // doesn't work :'(
			},
			'indexer',
			'category',
			]);

		// Do we want to include the deleted users?
		if(Session::get('active_status') == 'withTrashed')
		{
			$projects->withTrashed();
		}
		elseif(Session::get('active_status') == 'onlyTrashed')
		{
			$projects->onlyTrashed();
		}

		// Owner
		if(Session::get('project_owner') == 'current_user' || ! Session::has('project_owner'))
			$projects->where('created_by', '=', Sentry::getUser()->id);

		// Category
		if(Session::has('category_id') && is_numeric(Session::get('category_id')))
			$projects->where('category_id', '=', Session::get('category_id'));

		// dd($projects);

		return $projects->orderBy('created_at', 'DESC')
			->get();
	}

	/**
	 * Returns the Project table View rendered
	 *
	 * @return [type]
	 */
	public function postShowProjectTable()
	{
		Session::put('category_id', Input::get('category_id'));
		Session::put('active_status', Input::get('active_status'));
		Session::put('project_owner', Input::get('project_owner'));

		if(! Request::ajax())
			return false;

		$projects = $this->getProjects();
		$projectsTable = View::make('backend.projects.partials.projects-table', ['projects' => $projects])->render();

		return Response::json([
			'success' => true,
			'projectsTable' => $projectsTable
		], 200);
	}

	/*
	|--------------------------------------------------------------------------
	| Create
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Show the form for creating a new resource.
	 * GET /$COLLECTION$/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$project = new Project;
		$project->options = $this->projectOptions->getDefaultOptions();

		return View::make('backend.projects.create', compact('project'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /$COLLECTION$
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		// if(Input::get('website_title') !== '___')
		// 	die();

		try
		{
			$this->projectForm->validate(Input::all());

			$project = $this->execute(CreateNewProjectCommand::class);

			if($project)
			{
				Flash::success("Project {$project->label} successfully created!");

				// Redirect to the new project page
				return Redirect::route('edit/project', $project->id)->with('success');
			}

			// Redirect to the project create page
			return Redirect::route('create/project')->with('error');
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Edit
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Show the form for editing the specified resource.
	 * GET /$COLLECTION$/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($projectId = null)
	{
		$project = Project::with([
			'niche',
			'niche.children'
			])
			->find($projectId);


		// Check if the project exists
		if (is_null($project))
		{
			// Redirect to the blogs management page
			return Redirect::route('projects')->with('error', 'That niche doesn\'t exist!');
		}

		$project->options = $this->projectOptions->setOptionsTemplate($project->options);

		return View::make('backend.projects.edit', compact('project'));

		// return View::make('projects/edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /$COLLECTION$/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($projectId)
	{
		try
		{
			// Check if the project exists
			if (is_null($project = Project::find($projectId)))
			{
				// Redirect to the blogs management page
				return Redirect::to('projects')->with('error', 'That project does not exist! This should never happen!');
			}

			$this->projectForm->validate(Input::all());

			// Update the project data
			$project = $this->projectRepository->setData($project);

			// Was the project created?
			if($project->save())
			{
				// Flush the Project cache
				Cache::tags('projects')->flush();

				Flash::success('Project updated!');

				// Redirect to the new project page
				return Redirect::route('edit/project', $project->id);
			}

			// Redirect to the project edit page
			return Redirect::back()->withInput()->with('error');
		}

		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}



	/*
	|--------------------------------------------------------------------------
	| One-Click Actions
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Ping all of the project's sitemaps
	 *
	 * @param  integer $projectId
	 * @return Response
	 */
	public function getPingSitemaps($projectId)
	{
		if(! ProjectActions::pingSitemaps())
		{
			return Redirect::route('projects');
		}

		Flash::success("Pinging sitemaps for selected project!");

		return Redirect::route('projects');
	}

	/**
	 * Checks, updates, and creates the tracking_id for each Project automagically
	 *
	 * @return Resonse
	 */
	public function getCreatePiwikSites()
	{
		PiwikSiteFunctions::updateAllSites();

		Flash::success('All Projects update with Piwik!');

		return Redirect::route('projects');
	}

	/**
	 * Clears a Niche's content cache
	 *
	 * @param  integer $nicheId
	 * @return Response
	 */
	public function getClearCache($projectId)
	{
		if(! ProjectActions::clearCache($projectId))
			return Redirect::to('projects');

		return Redirect::route('projects');
	}

	/**
	 * Clears a Project's errors
	 *
	 * @param  integer $projectId
	 * @return Response
	 */
	public function getClearErrors($projectId)
	{
		if(! ProjectActions::clearErrors($projectId))
			return Redirect::to('projects');

		return Redirect::route('projects');
	}

	/**
	 * Calculates a Project's Niche's stats
	 *
	 * @param  integer $projectId
	 * @return Response
	 */
	public function getCalculateNicheStats($projectId)
	{
		if(! ProjectActions::calculateNicheStats($projectId))
			return Redirect::to('projects');

		Flash::success('Niche stats have been calculated!');

		return Redirect::route('projects');
	}

	/**
	 * Update all Project website URL and TLD
	 *
	 * @return null
	 */
	public function getUpdateFuckingProjectsJesusChrist()
	{
		//
	}

	/*
	|--------------------------------------------------------------------------
	| Delete the project?!?!
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Delete a Project
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($projectId)
	{
		// Check if the Project exists
		if (is_null($project = Project::find($projectId)))
		{
			Flash::error('That project doesn\'t exist!');

			return Redirect::route('projects');
		}

		$project->delete();

		Flash::success('Project has been deleted!');

		return Redirect::route('projects');
	}

}