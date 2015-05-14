<?php namespace Acme\ProjectStats;

class UpdateProjectStatsCommand {

	/**
	 * @var integer  $userId
	 */
	public $userId;

	/**
	 * Instantiate the object
	 *
	 * @param integer $userId
	 */
	function __construct($userId)
	{
		$this->userId = $userId;
	}
}