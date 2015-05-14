<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\SidebarForm;

class SidebarController extends AdminController {

	/**
	 * Sidebar validator
	 *
	 * @var SidebarForm $sidebarForm
	 */
	protected $sidebarForm;

	/**
	 * Instantiate the object;
	 *
	 * @param SidebarForm $sidebarForm
	 */
	public function __construct(SidebarForm $sidebarForm)
	{
		$this->sidebarForm = $sidebarForm;

		parent::__construct();
	}

	/**
	 * Show the Sidebar homepage
	 *
	 * @return Response
	 */
	public function getSidebarsIndex()
	{
		// Sidebar list
		$listSidebars = Sidebar::with([
			'widgets' => function($q) {
				$q->orderBy('widget_order', 'ASC');
				$q->addSelect('label');
			}
			])->get();
		// Fresh Sidebar for the form
		$sidebar = new Sidebar;
		// Widgets for the form
		$widgets = SidebarWidget::all();

		// Show the page
		return View::make('backend.appearance.sidebars', compact('listSidebars', 'sidebar', 'widgets'));
	}

	/**
	 * Create a new Sidebar
	 *
	 * @return Response
	 */
	public function postSidebarsIndex()
	{
		try
		{
			// Validate data & create new Sidebar
			$this->sidebarForm->validate(Input::all());
			$sidebar = new Sidebar;

			// Set normal data & save
			$sidebar = $this->setSidebarData($sidebar);

			// dd($sidebar);

			$sidebar->save();

			// Set Widget data & save
			$sidebar = $this->setSidebarWidgets($sidebar);

			Flash::success('Sidebar created!');

			return Redirect::route('sidebars');
		}

		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Show the Sidebar homepage
	 *
	 * @return Response
	 */
	public function getEditSidebar($sidebarId)
	{
		$sidebar = Sidebar::with([
			'widgets' => function($q) {
				$q->orderBy('widget_order', 'ASC');
				}
			])->find($sidebarId);

		// Check if the blog post exists
		if (is_null($sidebar))
		{
			// Redirect to the blogs management page
			Flash::error('That sidebar doesn\'t exist!');

			return Redirect::route('sidebars');
		}

		// Sidebar list
		$listSidebars = Sidebar::with([
			'widgets' => function($q) {
				$q->orderBy('widget_order', 'ASC');
				$q->addSelect('label');
			}
			])->get();
		// Widgets for the form
		$widgets = SidebarWidget::all();

		// Show the page
		return View::make('backend.appearance.editsidebar', compact('listSidebars', 'sidebar', 'widgets'));
	}

	/**
	 * Process editing a Sidebar
	 *
	 * @param  integer $sidebarId
	 * @return Response
	 */
	public function postEditSidebar($sidebarId)
	{
		try
		{
			// Validate data & create new Sidebar
			$this->sidebarForm->validate(Input::all());

			// Check if the blog post exists
			if (is_null($sidebar = Sidebar::find($sidebarId)))
			{
				// Redirect to the blogs management page
				Flash::error('That sidebar doesn\'t exist!');

				return Redirect::route('sidebars');
			}

			// Set normal data & save
			$sidebar = $this->setSidebarData($sidebar);

			$sidebar->save();

			// Set Widget data & save
			// $sidebar = $sidebar->widgets()->detach();
			$sidebar = $this->setSidebarWidgets($sidebar);

			Flash::success('Sidebar updated!');

			return Redirect::route('sidebars');
		}

		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Set a Sidebar's data
	 *
	 * @param Sidebar $sidebar
	 */
	public function setSidebarData(Sidebar $sidebar)
	{
		$sidebar->label			= e(Input::get('label'));
		$sidebar->slug			= Str::slug(Input::get('label'));
		$sidebar->widgets_list	= explode(',', Input::get('widget-ids'));

		return $sidebar;
	}

	/**
	 * Set the SidebarWidget relationships with a Sidebar
	 *
	 * @param Sidebar $sidebar
	 */
	public function setSidebarWidgets(Sidebar $sidebar)
	{
		// Grab & check widgetlist, then split to array
		$widgetList = Input::get('widget-ids');

		if(! empty($widgetList))
		{
			$widgetList = explode(',', $widgetList);

			// Create widgets array & order them
			$widgetSync = [];
			foreach($widgetList as $widgetOrder => $widgetId)
			{
				$widgetSync[$widgetId] = [
					'widget_order' => $widgetOrder,
				];
			}

			// dd($widgetSync);

			return $sidebar->widgets()->sync($widgetSync);
		}

		return false;
	}

	/**
	 * Delete a Sidebar
	 *
	 * @param  integer $sidebarId
	 * @return Response
	 */
	public function getDeleteSidebar($sidebarId)
	{
		// Check if the blog post exists
		if (is_null($sidebar = Sidebar::find($sidebarId)))
		{
			// Redirect to the email optins page
			Flash::error('That sidebar doesn\'t exist!');

			return Redirect::route('sidebars');
		}

		$sidebar->delete();

		Flash::success('Sidebar has been deleted!');

		return Redirect::route('sidebars');
	}

	/*
	|--------------------------------------------------------------------------
	| Sidebars - jQuery Ajax calls
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns a SidebarWidget sortable list item
	 *
	 * @return Response
	 */
	public function postAddWidgetToSidebar()
	{
		$widgetId = Input::get('widget_id');

		// Check if the widget exists
		if (is_null($widget = SidebarWidget::find($widgetId)))
		{
			return false;
		}

		// Return view with Widget
		return View::make('backend.appearance.partials.widget', ['widget' => $widget]);
	}

}