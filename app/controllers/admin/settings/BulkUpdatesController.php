<?php

class BulkUpdatesController extends AdminController {

	/**
	 * Bulk Project Updater dashboard
	 *
	 * @return Response
	 */
	public function getProjectUpdater()
	{
		// try
		// {
		// 	$listaccts = [json_decode(Cpanel::listaddondomains('shuttert'), true)];

		// 	return $listaccts;
		// }
		// catch(Exception $e)
		// {
		// 	return 'Exception: ' .$e->getMessage();
		// }

		return View::make('backend.settings.project-updater');
	}

	/**
	 * Bulk Project Updater process
	 *
	 * @return Response
	 */
	public function getProjectUpdaterProcess()
	{
		$projects = Project::where('created_by', '=', Sentry::getUser()->id)
			->orderBy('id')
			->get(['id']);

		// Loop each Project
		foreach($projects as $project)
		{
			if(! ProjectActions::calculateNicheStats($project->id))
			{
				Flash::error("Error calculating stats for {$project->website_title}'s Niches");

				return Redirect::to('bulk/project-updater');
			}
		}

		Flash::success("All of your Projects' Niche's stats have been updated!");

		return Redirect::route('bulk/project-updater');
	}
}