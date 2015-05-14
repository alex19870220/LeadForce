<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\Frontend\EmailOptinForm;
use Acme\Monetization\EmailOptins\Services\MailchimpService as MailchimpService;

class FrontendEmailOptinController extends BaseController {

	/**
	 * @var Project $project
	 */
	protected $project;

	/**
	 * @var EmailOptinForm $emailOptinForm
	 */
	protected $emailOptinForm;

	/**
	 * @var mixed $emailService
	 */
	protected $emailService;

	protected $subscriptionSuccessul = 'Thank you for subscribing! Please check your email for a confirmation email.';

	/**
	 * Instantiate the object
	 *
	 * @param EmailOptinForm $emailOptinForm
	 */
	public function __construct(EmailOptinForm $emailOptinForm)
	{
		$this->emailOptinForm = $emailOptinForm;

		// Route Parameters
		$this->project	= Route::input('projectSlug');

		parent::__construct();
	}

	/**
	 * Process email subscriptions
	 *
	 * @return Response
	 */
	public function postEmailOptin()
	{
		try
		{
			$this->emailOptinForm->validate(Input::all());

			// Subscribe!
			$this->subscribe(Input::get('email'));

			if(Request::ajax())
				return Response::json([
					'success' => true,
					'message' => $this->subscriptionSuccessul
				], 200);

			return Redirect::back();
		}
		catch (FormValidationException $e)
		{
			if(Request::ajax())
				return Response::json([
					'success' => false,
					'errors' => $e->getErrors()->toArray()
				], 400);

			return Redirect::back();
		}
	}

	/**
	 * Subscribe someone to an email lst
	 *
	 * @param  string $email
	 * @return bool
	 */
	public function subscribe($email)
	{
		$projectEsp = $this->project->getOption('monetization.email_optin.provider');

		switch ($projectEsp)
		{
			case 'mailchimp':
				$apiKey = $this->project->getOption('monetization.email_optin.mailchimp.api_key');
				$list = $this->project->getOption('monetization.email_optin.mailchimp.list');
				$emailService = new MailchimpService($apiKey);
				break;
		}

		if(! $emailService->subscribeTo($list, $email))
			throw new FormValidationException(['email_service' => 'There has been an error subscribing to the service.']);
	}

	/**
	 * Returns a JSON error response
	 *
	 * @param  string $errors
	 * @return Response
	 */
	private function returnError($errors = '')
	{
		return Response::json([
			'success' => false,
			'errors' => $errors
		], 400);
	}
}