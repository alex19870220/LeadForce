<?php

class UsersController extends AdminController {

	protected $userForm;

	function __construct(Acme\Forms\UserForm $userForm)
	{
		parent::__construct();

		$this->userForm = $userForm;
	}

	/**
	 * Show a list of all the users.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// Grab all the users
		$users = User::with([
			'projects' => function($q)
				{
					$q->select('id', 'created_by');
				},
			'niches' => function($q)
				{
					$q->select('id', 'user_id');
				},
			'groups'
			]);

		// Do we want to include the deleted users?
		if (Input::get('withTrashed'))
		{
			$users = $users->withTrashed();
		}
		else if (Input::get('onlyTrashed'))
		{
			$users = $users->onlyTrashed();
		}

		// Paginate the users
		$users = $users->paginate()
			->appends(array(
				'withTrashed' => Input::get('withTrashed'),
				'onlyTrashed' => Input::get('onlyTrashed'),
			));

		// Show the page
		return View::make('backend.users.index', compact('users'));
	}

	/**
	 * User create.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		// Get all the available groups
		$groups = Sentry::getGroupProvider()->findAll();

		// Selected groups
		$selectedGroups = Input::old('groups', array());

		// Get all the available permissions
		$permissions = Config::get('permissions');
		$this->encodeAllPermissions($permissions);

		// Selected permissions
		$selectedPermissions = Input::old('permissions', array('superuser' => -1));
		$this->encodePermissions($selectedPermissions);

		$user = new User;
		$userPermissions = [];

		// Show the page
		return View::make('backend.users.create', compact('groups', 'selectedGroups', 'permissions', 'selectedPermissions', 'user', 'userPermissions'));
	}

	/**
	 * User create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		// Create a new validator instance from our validation rules
		$this->userForm->validate(Input::all());

		try
		{
			// We need to reverse the UI specific logic for our
			// permissions here before we create the user.
			$permissions = Input::get('permissions', array());
			$this->decodePermissions($permissions);
			app('request')->request->set('permissions', $permissions);

			// Get the inputs, with some exceptions
			$inputs = Input::except('csrf_token', 'password_confirm', 'groups');

			// Was the user created?
			if ($user = Sentry::getUserProvider()->create($inputs))
			{
				// Assign the selected groups to this user
				foreach (Input::get('groups', array()) as $groupId)
				{
					$group = Sentry::getGroupProvider()->findById($groupId);

					$user->addGroup($group);
				}

				// Prepare the success message
				Flash::success(Lang::get('admin/users/message.success.create'));

				// Redirect to the new user page
				return Redirect::route('update/user', $user->id);
			}

			// Prepare the error message
			Flash::error(Lang::get('admin/users/message.error.create'));

			// Redirect to the user creation page
			return Redirect::route('create/user');
		}
		catch (LoginRequiredException $e)
		{
			$error = Lang::get('admin/users/message.user_login_required');
		}
		catch (PasswordRequiredException $e)
		{
			$error = Lang::get('admin/users/message.user_password_required');
		}
		catch (UserExistsException $e)
		{
			$error = Lang::get('admin/users/message.user_exists');
		}

		Flash::error($error);

		// Redirect to the user creation page
		return Redirect::route('create/user')->withInput();
	}

	/**
	 * User update.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = null)
	{
		try
		{
			// Get the user's info
			$user = Sentry::getUserProvider()->findById($id);

			// Get this user's groups
			$userGroups = $user->groups()->lists('name', 'group_id');

			// Get this user's permissions
			$userPermissions = array_merge(Input::old('permissions', array('superuser' => -1)), $user->getPermissions());
			$this->encodePermissions($userPermissions);

			// Get a list of all the available groups
			$groups = Sentry::getGroupProvider()->findAll();

			// Get all the available permissions
			$permissions = Config::get('permissions');
			$this->encodeAllPermissions($permissions);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			Flash::error(Lang::get('admin/users/message.user_not_found', compact('id')));

			// Redirect to the user management page
			return Redirect::route('users');
		}

		// Show the page
		return View::make('backend.users.edit', compact('user', 'groups', 'userGroups', 'permissions', 'userPermissions'));
	}

	/**
	 * User update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id = null)
	{
		// We need to reverse the UI specific logic for our
		// permissions here before we update the user.
		$permissions = Input::get('permissions', array());
		$this->decodePermissions($permissions);
		app('request')->request->set('permissions', $permissions);

		try
		{
			// Get the user information
			$user = Sentry::getUserProvider()->findById($id);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			Flash::error(Lang::get('admin/users/message.user_not_found', compact('id')));

			// Redirect to the user management page
			return Redirect::route('users');
		}

		//
		$this->validationRules['email'] = "required|email";

		// Do we want to update the user password?
		if ( ! $password = Input::get('password'))
		{
			unset($this->validationRules['password']);
			unset($this->validationRules['password_confirm']);
			#$this->validationRules['password']         = 'required|between:3,32';
			#$this->validationRules['password_confirm'] = 'required|between:3,32|same:password';
		}

		// Create a new validator instance from our validation rules
		$this->userForm->validate(Input::all());

		try
		{
			// Update the user
			$user->first_name  = Input::get('first_name');
			$user->last_name   = Input::get('last_name');
			$user->email       = Input::get('email');
			$user->activated   = Input::get('activated', $user->activated);
			$user->permissions = Input::get('permissions');

			// Do we want to update the user password?
			if ($password)
			{
				$user->password = $password;
			}

			// Get the current user groups
			$userGroups = $user->groups()->lists('group_id', 'group_id');

			// Get the selected groups
			$selectedGroups = Input::get('groups', array());

			// Groups comparison between the groups the user currently
			// have and the groups the user wish to have.
			$groupsToAdd    = array_diff($selectedGroups, $userGroups);
			$groupsToRemove = array_diff($userGroups, $selectedGroups);

			// Assign the user to groups
			foreach ($groupsToAdd as $groupId)
			{
				$group = Sentry::getGroupProvider()->findById($groupId);

				$user->addGroup($group);
			}

			// Remove the user from groups
			foreach ($groupsToRemove as $groupId)
			{
				$group = Sentry::getGroupProvider()->findById($groupId);

				$user->removeGroup($group);
			}

			// Was the user updated?
			if ($user->save())
			{
				// Prepare the success message
				Flash::success(Lang::get('admin/users/message.success.update'));

				// Redirect to the user page
				return Redirect::route('update/user', $id);
			}

			// Prepare the error message
			Flash::error(Lang::get('admin/users/message.error.update'));
		}
		catch (LoginRequiredException $e)
		{
			Flash::error(Lang::get('admin/users/message.user_login_required'));
		}

		Flash::danger($error);

		// Redirect to the user page
		return Redirect::route('update/user', $user->id)->withInput();
	}

	/**
	 * Delete the given user.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getDelete($id = null)
	{
		try
		{
			// Get user information
			$user = Sentry::getUserProvider()->findById($id);

			// Check if we are not trying to delete ourselves
			if ($user->id === Sentry::getId())
			{
				// Prepare the error message
				Flash::error(Lang::get('admin/users/message.error.delete'));

				// Redirect to the user management page
				return Redirect::route('users');
			}

			// Do we have permission to delete this user?
			if ($user->isSuperUser() and ! Sentry::getUser()->isSuperUser())
			{
				Flash::error('Insufficient permissions!');

				// Redirect to the user management page
				return Redirect::route('users');
			}

			// Delete the user
			$user->delete();

			// Prepare the success message
			Flash::success(Lang::get('admin/users/message.success.delete'));

			// Redirect to the user management page
			return Redirect::route('users');
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			Flash::error(Lang::get('admin/users/message.user_not_found', compact('id' )));

			// Redirect to the user management page
			return Redirect::route('users');
		}
	}

	/**
	 * Restore a deleted user.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getRestore($id = null)
	{
		try
		{
			// Get user information
			$user = Sentry::getUserProvider()->createModel()->withTrashed()->find($id);

			// Restore the user
			$user->restore();

			// Prepare the success message
			Flash::success(Lang::get('admin/users/message.success.restored'));

			// Redirect to the user management page
			return Redirect::route('users');
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			Flash::error(Lang::get('admin/users/message.user_not_found', compact('id')));

			// Redirect to the user management page
			return Redirect::route('users');
		}
	}

}