<?php namespace Acme\Repositories;

use DB;
use User;

class UserRepository {

	/**
	 * Persist a user
	 *
	 * @param User $user
	 * @return mixed
	 */
	public function save(User $user)
	{
		$user->save();
	}

	/**
	 * Get a paginated list of all users.
	 *
	 * @param int $howMany
	 * @return mixed
	 */
	public function getPaginated($howMany = 25)
	{
		return User::orderBy('username', 'asc')->paginate($howMany);
	}

	/**
	 * Fetch a user & relationships by their username.
	 *
	 * @param $username
	 * @return mixed
	 */
	public function findByUsername($username)
	{
		return User::with([
			'statuses',
			'statuses.user',
			'statuses.comments',
			'statuses.comments.owner',
			'followers',
			'following',
			])
			->whereUsername($username)
			->first();
	}

	/**
	 * Find a user by their id.
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findById($id)
	{
		return User::findOrFail($id);
	}

	/**
	 * Follow a Larabook user.
	 *
	 * @param $userIdToFollow
	 * @param User $user
	 * @return mixed
	 */
	public function follow($userIdToFollow, User $user)
	{
		return $user->following()->attach($userIdToFollow);
	}

	/**
	 * Unfollow a Larabook user.
	 *
	 * @param $userIdToUnfollow
	 * @param User $user
	 * @return mixed
	 */
	public function unfollow($userIdToUnfollow, User $user)
	{
		return $user->following()->detach($userIdToUnfollow);
	}

}