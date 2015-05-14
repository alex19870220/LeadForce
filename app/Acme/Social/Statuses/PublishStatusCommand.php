<?php namespace Acme\Social\Statuses;

class PublishStatusCommand {

	/**
	 * @var string $body
	 */
	public $body;

	/**
	 * @var integer $userId
	 */
	public $userId;

	/**
	 * Instantiate the Command
	 *
	 * @param string $body
	 * @param integer $userId
	 */
	function __construct($body, $userId)
	{
		$this->body = $body;
		$this->userId = $userId;
	}

}