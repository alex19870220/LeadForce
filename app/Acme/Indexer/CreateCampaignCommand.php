<?php namespace Acme\Indexer;

class CreateCampaignCommand {

	/**
	 * @var integer  $project_id
	 */
	public $project_id;

	/**
	 * Instantiate the object
	 *
	 * @param integer $project_id
	 */
	function __construct($project_id)
	{
		$this->project_id = $project_id;
	}

}