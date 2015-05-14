<?php namespace Acme\Indexer;

class BuildVideoCacheCommand {

	public $project_id;

	function __construct($project_id)
	{
		$this->project_id = $project_id;
	}
}