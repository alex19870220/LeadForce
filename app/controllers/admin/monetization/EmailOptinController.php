<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\OptinFormForm;
use Acme\Monetization\EmailOptins\Services\MailchimpService;

class EmailOptinController extends AdminController {

	/**
	 * @var Object implements EmailOptinInterface
	 */
	protected $emailOptinService;

	/**
	 * @var Object implements EmailOptinInterface
	 */
	protected $mailchimp_apiKey = '';

	protected $mailchimp_list = '';

	/**
	 * Instantiate the object
	 *
	 * @param OptinFormForm $optinFormForm
	 */
	public function __construct(OptinFormForm $optinFormForm)
	{
		$this->optinFormForm = $optinFormForm;

		parent::__construct();
	}

	/**
	 * Email Optin dashbord
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$forms = OptinForm::orderBy('id', 'DESC')->get();

		// New form for the create form
		$newForm = new OptinForm;

		// Show the page
		return View::make('backend.monetization.emailoptins', compact('forms', 'newForm'));
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
			$this->optinFormForm->validate(Input::all());

			// Create a new email optin
			$emailOptinForm = new OptinForm;

			// Update the email optin data
			$emailOptinForm = $this->setData($emailOptinForm);

			// Was the email optin created?
			if($emailOptinForm->save())
			{
				Flash::success("Email Optin \"{$emailOptinForm->label}\" has been created!");

				// Redirect to the new email optin page
				return Redirect::route('email-optins')->with('success');
			}

			// Redirect to the email optin create page
			return Redirect::route('email-optins')->withErrors($e->getErrors());
		}
		catch (FormValidationException $e)
		{
			Flash::error($e->getErrors()->toArray());

			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Edit an email optin
	 *
	 * @param  integer $emailOptinId
	 * @return Response
	 */
	public function getEdit($emailOptinId)
	{
		// Check if the email optin exists
		if (is_null($emailOptinForm = OptinForm::find($emailOptinId)))
		{
			// Redirect to the email optins page
			Flash::error('That email optin doesn\'t exist!');

			return Redirect::route('email-optins');
		}

		return View::make('backend.monetization.editemailoptin', compact('emailOptinForm'));
	}

	/**
	 * Edit an Email Optin form
	 *
	 * @param  integer $emailOptinId
	 * @return Response
	 */
	public function postEdit($emailOptinId)
	{
		try
		{
			// Check if the email optin exists
			if (is_null($emailOptinForm = OptinForm::find($emailOptinId)))
			{
				// Redirect to the email optins page
				Flash::error('That email optin doesn\'t exist!');

				return Redirect::route('email-optins');
			}

			$this->optinFormForm->validate(Input::all());

			// dd(Input::all());

			// Update the email optin data
			$emailOptinForm = $this->setData($emailOptinForm);

			// Was the email optin created?
			if($emailOptinForm->save())
			{
				Flash::success("Email Optin \"{$emailOptinForm->label}\" has been updated!");

				// Redirect to the new email optin page
				return Redirect::route('email-optins')->with('success');
			}

			// Redirect to the email optin create page
			return Redirect::route('email-optins')->withErrors($e->getErrors());
		}
		catch (FormValidationException $e)
		{
			Flash::error($e->getErrors()->toArray());

			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Delete an email opin
	 *
	 * @param  integer $emailOptinId
	 * @return Response
	 */
	public function getDelete($emailOptinId)
	{
		// Check if the blog post exists
		if (is_null($emailOptinForm = OptinForm::find($emailOptinId)))
		{
			// Redirect to the email optins page
			Flash::error('That email optin doesn\'t exist!');

			return Redirect::route('email-optins');
		}

		$emailOptinForm->delete();

		Flash::success('Email optin has been deleted!');

		return Redirect::route('email-optins');
	}

	/*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Sets the data of the Optin Form and returns it
	 *
	 * @param OptinForm $emailOptinForm
	 */
	public function setData(OptinForm $emailOptinForm)
	{
		$emailOptinForm->label		= e(Input::get('label'));
		$emailOptinForm->title		= e(Input::get('title'));
		$emailOptinForm->sub_text	= Input::get('sub_text');

		$emailOptinForm->form_data	= [
			'button_text'	=> Input::get('button_text', null),
			'button_color'	=> Input::get('button_color', null),
			'form_action'	=> Input::get('form_action', null),
		];

		return $emailOptinForm;
	}

	/*
	|--------------------------------------------------------------------------
	| Random Shit
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Testing subscribtion form
	 *
	 * @return Response
	 */
	public function testSubscribe()
	{
		$this->project = Project::find(12)->select('options')->first();

		$emailOptinService = new MailchimpService($this->getApiKey());
		$this->emailOptinService = $emailOptinService;
		// Subscribe
		$this->emailOptinService->subscribeTo($this->getList(), 'bluejd910@gmail.com');

		// Show the page
		return View::make('backend.monetization.emailoptins');
	}

	/**
	 * Returns the Config path to the given API key name
	 *
	 * @param  string $apiKeyAccount
	 * @return string
	 */
	public function getApiKey()
	{
		return $this->project->getOption('monetization.email_optin.mailchimp.api_key');
	}

	/**
	 * Gets the list ID from the Config
	 *
	 * @param  string $list
	 * @return string
	 */
	protected function getList($list)
	{
		return $this->project->getOption('monetization.email_optin.mailchimp.list');
	}
}