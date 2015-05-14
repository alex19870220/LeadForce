<?php

use Acme\Repositories\UserRepository;
use Acme\Forms\FormValidationException;
use Acme\Forms\UserProfileForm;

class ProfileController extends AdminController {

	/**
	 * @var UserProfileForm $userProfileForm
	 */
	protected $userProfileForm;

	/**
	 * @var UserRepository $userRepository
	 */
	protected $userRepository;

	/**
	 * Instantiate the Object
	 *
	 * @param UserProfileForm $userProfileForm
	 */
	public function __construct(UserProfileForm $userProfileForm, UserRepository $userRepository)
	{
		$this->userProfileForm = $userProfileForm;
		$this->userRepository = $userRepository;

		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Edit Profile
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * User profile page.
	 *
	 * @return Response
	 */
	public function getUpdateProfile()
	{
		// Show the page
		return View::make('backend.account.profile');
	}

	/**
	 * User profile form processing page.
	 *
	 * @return Redirect
	 */
	public function postUpdateProfile()
	{
		try
		{
			$this->userProfileForm->validate(Input::all());

			// Grab the user
			$user = Sentry::getUser();

			// Update the user information
			$user->username		= e(Input::get('username'));
			$user->first_name	= e(Input::get('first_name'));
			$user->last_name	= e(Input::get('last_name'));
			$user->website		= e(Input::get('website'));
			$user->country		= e(Input::get('country'));
			$user->gravatar		= Input::get('gravatar');

			$contactInfo = Input::get('contact_info');
			array_map('e', $contactInfo);
			$user->contact_info	= $contactInfo;

			if($user->save())
			{
				Flash::success("Your profile has been updated!");

				// Redirect to the new project page
				return Redirect::route('account/profile');
			}
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		// Redirect to the project create page
		Flash::error("Something went wrong :'(");

		return Redirect::route('account/profile');
	}

	/*
	|--------------------------------------------------------------------------
	| View User
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * View a User
	 *
	 * @param  string $username
	 * @return Response
	 */
	public function getViewUsername($username)
	{
		if(! $user = $this->userRepository->findByUsername($username))
		{
			Flash::error("User not found!");

			return Redirect::route('dashboard');
		}

		$statuses = $user->statuses;

		return View::make('backend.profile.view-profile', compact('user', 'statuses'));
	}

}
