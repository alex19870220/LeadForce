<?php namespace Acme\Social\Users;

class UnfollowUserCommand {

	/**
	 * @var string
	 */
	public $userId;

	/**
	 * @var string
	 */
	public $userIdToUnfollow;

	/**
	 * @param string userId
	 * @param string userIdToUnfollow
	 */
	function __construct($userId, $userIdToUnfollow)
	{
		$this->userId = $userId;
		$this->userIdToUnfollow = $userIdToUnfollow;
	}

}