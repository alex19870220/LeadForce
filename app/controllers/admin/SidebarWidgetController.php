<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\SidebarWidgetForm;

class SidebarWidgetController extends AdminController {

	/**
	 * Widget validator
	 *
	 * @var SidebarWidgetForm $widgetForm
	 */
	protected $widgetForm;

	/**
	 * The types of Widgets
	 *
	 * @var array $widgetTypes
	 */
	protected $widgetTypes = [
		'monetization'	=> [
			'label'			=> 'Monetization Widgets',
			'showdiv'		=> 'widget-input',
			'types'		=> [
				'emailoptin'	=> 'Email Optin Form',
				'leadgen'		=> 'Leadgen Form',
			],
		],
		'custom'		=> [
			'label'			=> 'Custom Widgets',
			'showdiv'		=> 'widget-textarea',
			'types'		=> [
				'html'			=> 'Custom HTML',
				'hardcoded'		=> 'Hard Coded (developers only)',
			],
		],
	];

	/**
	 * Instantiate the object;
	 *
	 * @param SidebarWidgetForm $widgetForm
	 */
	public function __construct(SidebarWidgetForm $widgetForm)
	{
		$this->widgetForm = $widgetForm;

		$widgetTypes = json_decode(json_encode($this->widgetTypes));
		View::share('widgetTypes', $widgetTypes);

		parent::__construct();
	}

	/**
	 * Show the Widget homepage
	 *
	 * @return Response
	 */
	public function getWidgetsIndex()
	{
		$hardcodedWidgets = SidebarWidget::where('type', '=', 'hardcoded')
			->orderBy('label', 'ASC')
			->get();

		$monetizationWidgets = SidebarWidget::where('type', '!=', 'hardcoded')
			->orderBy('type', 'DESC')
			->orderBy('label', 'ASC')
			->get();

		$newWidget = new SidebarWidget;

		// Show the page
		return View::make('backend.appearance.widgets', compact('hardcodedWidgets', 'monetizationWidgets', 'newWidget'));
	}

	/**
	 * Creates a new SidebarWidget
	 *
	 * @return Response
	 */
	public function postWidgetsIndex()
	{
		try
		{
			$this->widgetForm->validate(Input::all());

			$widget = new SidebarWidget;
			$widget = $this->setWidgetData($widget);
			if($widget->save())
			{
				Flash::success('Widget created!');

				return Redirect::route('widgets');
			}
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Shows the edit SidebarWidget modal
	 *
	 * @param  integer $widgetId
	 * @return Response
	 */
	public function getEditWidget($widgetId)
	{
		// Check if the blog post exists
		if (is_null($widget = SidebarWidget::find($widgetId)))
		{
			// Redirect to the blogs management page
			Flash::error('That widget doesn\'t exist!');

			return Redirect::route('widgets');
		}

		return View::make('backend.appearance.editwidget', compact('widget'));
	}

	/**
	 * Submit the modified SidebarWidget
	 *
	 * @param  integer $widgetId
	 * @return Response
	 */
	public function postEditWidget($widgetId)
	{
		// Check if the blog post exists
		if (is_null($widget = SidebarWidget::find($widgetId)))
		{
			// Redirect to the blogs management page
			Flash::error('That widget doesn\'t exist!');

			return Redirect::route('widgets');
		}

		$widget = $this->setWidgetData($widget);
		$widget->save();

		Flash::success('Widget updated!');

		return Redirect::route('widgets');
	}

	/**
	 * Sets the Widget data and returns it
	 *
	 * @param SidebarWidget $widget
	 */
	public function setWidgetData(SidebarWidget $widget)
	{
		$widgetType			= Input::get('type');
		// Set data
		$widget->label		= e(Input::get('label'));
		$widget->slug		= Str::slug(e(Input::get('label')));
		$widget->title		= e(Input::get('title'));
		$widget->type		= $widgetType;
		$widget->view		= e(Input::get('view'));
		$widget->form_id	= e(Input::get('form_id'));
		$widget->contents	= Input::get('contents');

		return $widget;
	}

	/**
	 * Delete a Widget
	 *
	 * @param  integer $widgetId
	 * @return Response
	 */
	public function getDeleteWidget($widgetId)
	{
		// Check if the Niche exists
		if (is_null($sidebarWidget = SidebarWidget::find($widgetId)))
		{
			Flash::error('That Widget doesn\'t exist!');

			return Redirect::route('widgets');
		}

		$sidebarWidget->delete();

		Flash::success('Widget has been deleted!');

		return Redirect::route('widgets');
	}

}