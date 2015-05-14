<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\LeadgenFormForm;

class LeadgenController extends AdminController {

	/**
	 * Instantiate the object
	 *
	 * @param LeadgenFormForm $leadgenForm
	 */
	public function __construct(LeadgenFormForm $leadgenForm)
	{
		$this->leadgenForm = $leadgenForm;

		parent::__construct();
	}

	/**
	 * Lead Gen Form dashboard
	 *
	 * @return [type]
	 */
	public function getIndex()
	{
		$forms = LeadgenForm::orderBy('id', 'DESC')->get();

		// New form for the create form
		$newForm = new LeadgenForm;

		// Show the page
		return View::make('backend.monetization.leadgen', compact('forms', 'newForm'));
	}

	/**
	 * Create a new Email Optin form
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		try
		{
			$this->leadgenForm->validate(Input::all());

			// Create a new email optin
			$leadgenForm = new LeadgenForm;

			// Update the email optin data
			$leadgenForm = $this->setData($leadgenForm);

			// Was the email optin created?
			if($leadgenForm->save())
			{
				Flash::success("Email Optin \"{$leadgenForm->label}\" has been created!");

				// Redirect to the new email optin page
				return Redirect::route('leadgen-forms');
			}

			// Redirect to the email optin create page
			return Redirect::route('leadgen-forms')->withErrors($e->getErrors());
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Edit an email optin
	 *
	 * @param  integer $leadgenFormId
	 * @return Response
	 */
	public function getEdit($leadgenFormId)
	{
		// Check if the email optin exists
		if (is_null($leadgenForm = LeadgenForm::find($leadgenFormId)))
		{
			// Redirect to the email optins page
			Flash::error('That email optin doesn\'t exist!');

			return Redirect::route('leadgen-forms');
		}

		return View::make('backend.monetization.leadgen_edit', compact('leadgenForm'));
	}

	/**
	 * Edit an Email Optin form
	 *
	 * @param  integer $leadgenFormId
	 * @return Response
	 */
	public function postEdit($leadgenFormId)
	{
		try
		{
			// Check if the email optin exists
			if (is_null($leadgenForm = LeadgenForm::find($leadgenFormId)))
			{
				// Redirect to the email optins page
				Flash::error('That email optin doesn\'t exist!');

				return Redirect::route('leadgen-forms');
			}

			$this->leadgenForm->validate(Input::all());

			// dd(Input::all());

			// Update the email optin data
			$leadgenForm = $this->setData($leadgenForm);

			// Was the email optin created?
			if($leadgenForm->save())
			{
				Flash::success("Email Optin \"{$leadgenForm->label}\" has been updated!");

				// Redirect to the new email optin page
				return Redirect::route('leadgen-forms');
			}

			// Redirect to the email optin create page
			return Redirect::route('leadgen-forms')->withErrors($e->getErrors());
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Preview a Leadgen Form's form fields
	 *
	 * @param  integer $leadgenFormId
	 * @return Response
	 */
	public function getPreviewForm($leadgenFormId)
	{
		// Check if the blog post exists
		if (is_null($leadgenForm = LeadgenForm::find($leadgenFormId)))
		{
			// Redirect to the email optins page
			Flash::error('That email optin doesn\'t exist!');

			return Redirect::route('leadgen-forms');
		}

		return View::make('backend.monetization.partials.leadgen_previewform', compact('leadgenForm'));
	}

	/**
	 * Delete an email opin
	 *
	 * @param  integer $leadgenFormId
	 * @return Response
	 */
	public function getDelete($leadgenFormId)
	{
		// Check if the blog post exists
		if (is_null($leadgenForm = LeadgenForm::find($leadgenFormId)))
		{
			// Redirect to the email optins page
			Flash::error('That email optin doesn\'t exist!');

			return Redirect::route('leadgen-forms');
		}

		$leadgenForm->delete();

		Flash::success('Email optin has been deleted!');

		return Redirect::route('leadgen-forms');
	}

	/*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Sets the data of the Leadgen Form and returns it
	 *
	 * @param LeadgenForm $leadgenForm
	 */
	public function setData(LeadgenForm $leadgenForm)
	{
		$leadgenForm->user_id		= Sentry::getId();
		$leadgenForm->label			= e(Input::get('label'));
		$leadgenForm->title			= e(Input::get('title'));
		$leadgenForm->style			= e(Input::get('style'));

		return $leadgenForm;
	}

}