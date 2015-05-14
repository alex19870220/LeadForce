<?php namespace Acme\Social\Statuses;

class LeaveCommentOnStatusCommand {

	/**
	 * @var string
	 */
	public $userId;

	/**
	 * @var string
	 */
	public $status_id;

	/**
	 * @var string
	 */
	public $body;

	/**
	 * @param string userId
	 * @param string status_id
	 * @param string body
	 */
	function __construct($userId, $status_id, $body)
	{
		$this->userId = $userId;
		$this->status_id = $status_id;
		$this->body = $body;
	}

}