<?php

use Acme\Social\Users\FollowUserCommand;
use Acme\Social\Users\UnfollowUserCommand;
use Laracasts\Commander\CommanderTrait;

class FollowsController extends AdminController {

	use CommanderTrait;

	/**
	 * Returns the Follows button to Follow or Unfollow a user
	 *
	 * @param  integer $userId
	 * @return View
	 */
	public function getFollowsButton($user)
	{
		return View::make('backend.profile.partials.follows', ['user' => $user])->render();
	}

	/**
	 * Follow or unfollow a user
	 *
	 * @return Response
	 */
	public function postUserFollows($userId)
	{
		if(! $user = User::find($userId))
		{
			Flash::error("User not found!");

			return Redirect::back();
		}

		$currentUser = Sentry::getUser();

		// Check if user is followed or not by current user
		if(! $user->isFollowedBy($currentUser))
		{
			$this->execute(FollowUserCommand::class, ['userId' => $currentUser->id, 'userIdToFollow' => $user->id]);
		}
		else
		{
			$this->execute(UnfollowUserCommand::class, ['userId' => $currentUser->id, 'userIdToUnfollow' => $user->id]);
		}

		if(Request::ajax())
			return Response::json([
				'success'	=> true,
				'output'	=> View::make('backend.profile.partials.follows', ['user' => $user])->render()
			], 200);

		return Redirect::back();

	}
}