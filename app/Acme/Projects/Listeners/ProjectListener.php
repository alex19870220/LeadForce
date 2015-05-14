<?php namespace Acme\Projects\Listeners;

use Acme\Projects\Events\ProjectWasCreated;
use Laracasts\Commander\Events\EventListener;

class ProjectListener extends EventListener {

	/**
	 * When a Project was created
	 *
	 * @param  ProjectWasCreated $event
	 * @return bool
	 */
	public function whenProjectWasCreated(ProjectWasCreated $event)
	{
		//
	}
}