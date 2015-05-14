<?php

use Acme\Forms\PageForm;

class PagesController extends AdminController {

	protected $pageForm;

	function __construct(Acme\Forms\PageForm $pageForm)
	{
		parent::__construct();

		$this->pageForm = $pageForm;

		// Grab all Projects & share them
		$projects = Project::orderBy('label', 'ASC')->get(['id', 'label']);
		View::share('projects', $projects);
	}

	/**
	 * Show a list of all the page pages.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// Grab all the page pages
		$pages = new Page;

		// Do we want to include the deleted users?
		if (Input::get('withTrashed'))
		{
			$pages = $pages->withTrashed();
		}
		else if (Input::get('onlyTrashed'))
		{
			$pages = $pages->onlyTrashed();
		}

		// Filter by Project
		if (Input::get('projectId'))
		{
			$pages = $pages->where('project_id', '=', Input::get('projectId'));
		}

		// Paginate the pages
		$pages = $pages->paginate()
			->appends(array(
				'withTrashed' => Input::get('withTrashed'),
				'onlyTrashed' => Input::get('onlyTrashed'),
			));

		// Grab all the pages
		$pages = Page::orderBy('created_at', 'DESC')->paginate(20);

		// Show the page
		return View::make('backend.pages.dashboard', compact('pages'));
	}

	/**
	 * Page page create.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		// Create a blank Page
		$page = new Page;

		// Show the page
		return View::make('backend.pages.create', compact('page'));
	}

	/**
	 * Page page create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		$this->pageForm->validate(Input::all());

		// Create a new Page
		$page = new Page;

		// Update the page page data
		$page = $this->setData($page);

		// Was the page page created?
		if($page->save())
		{
			// Redirect to the new page page page
			return Redirect::route('edit/page', $page->id)->with('success', Lang::get('admin/pages/message.create.success'));
		}

		// Redirect to the page page create page
		return Redirect::route('create/page')->with('error', Lang::get('admin/pages/message.create.error'));
	}

	/**
	 * Page page update.
	 *
	 * @param  int  $pageId
	 * @return Response
	 */
	public function getEdit($pageId = null)
	{
		// Check if the page page exists
		if (is_null($page = Page::find($pageId)))
		{
			// Redirect to the pages management page
			return Redirect::route('pages')->with('error', Lang::get('admin/pages/message.does_not_exist'));
		}

		// Show the page
		return View::make('backend.pages.edit', compact('page'));
	}

	/**
	 * Page Page update form processing page.
	 *
	 * @param  int  $pageId
	 * @return Redirect
	 */
	public function postEdit($pageId = null)
	{
		$this->pageForm->validate(Input::all());

		// Create a new Page
		$page = Page::find($pageId);

		// Update the page page data
		$page = $this->setData($page);

		// Was the page page updated?
		if($page->save())
		{
			// Redirect to the new page page page
			return Redirect::route('edit/page', $page->id)->with('success', Lang::get('admin/pages/message.update.success'));
		}

		// Redirect to the pages page management page
		return Redirect::route('edit/page', $page->id)->with('error', Lang::get('admin/pages/message.update.error'));
	}

	/**
	 * Delete the given page page.
	 *
	 * @param  int  $pageId
	 * @return Redirect
	 */
	public function getDelete($pageId)
	{
		// Check if the page page exists
		if (is_null($page = Page::find($pageId)))
		{
			// Redirect to the pages management page
			return Redirect::route('pages')->with('error', Lang::get('admin/pages/message.not_found'));
		}

		// Delete the page page
		$page->delete();

		// Redirect to the page pages management page
		return Redirect::route('pages')->with('success', Lang::get('admin/pages/message.delete.success'));
	}

	public function setData(Page $page)
	{
		$page->project_id		= e(Input::get('project_id'));
		$page->title			= e(Input::get('title'));
		$page->slug				= e(Str::slug(Input::get('title')));
		$page->content			= Input::get('content');
		$page->layout			= e(Input::get('layout'));

		$page->menu_label		= e(Input::get('menu_label'));
		$page->icon				= e(Input::get('icon'));
		$page->location			= e(Input::get('location'));
		$page->page_order		= e(Input::get('page_order'));
		$page->sidebar_id		= e(Input::get('sidebar_id'));

		// $page->options 			= $this->setOptions();		// Fix me!
		$page->active			= Input::get('active', false);

		// $page->meta_title       = e(Input::get('meta-title'));
		// $page->meta_description = e(Input::get('meta-description'));
		// $page->user_id          = Sentry::getId();

		return $page;
	}

}
