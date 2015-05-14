<?php namespace Acme\Projects\Events;

use Project;

class ProjectWasCreated {

	/**
	 * @var Project $project
	 */
	public $project;

	/**
	 * Instantiate the object
	 *
	 * @param Project $project
	 */
	function __construct(Project $project) /* or pass in just the relevant fields */
    {
        $this->project = $project;
    }
}