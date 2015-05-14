<?php namespace Acme\Projects;

use Acme\Piwik\PiwikSiteFunctions;
use CacheTags;
use Flash;
use Project;
use Queue;

class ProjectActions {


	/**
	 * Ping a Project's sitemaps
	 *
	 * @param  integer $projectId
	 * @return Response
	 */
	public function pingSitemaps($projectId)
	{
		// Check if Project exists
		if(! $project = Project::select('id')->find($projectId))
		{
			Flash::error("Project not found!");

			return false;
		}

		// Push the job into the Queue
		Queue::push('Acme\Sitemaps\Queues\QueueRebuildSitemap', ['projectId' => $project->id]);

		return true;
	}

	/**
	 * Clears a Project's Cache
	 *
	 * @param  integer $projectId
	 * @return bool
	 */
	public function clearCache($projectId)
	{
		ini_set('memory_limit','256M');

		// Check if the Project exists
		if (is_null($project = Project::find($projectId)))
		{
			Flash::error('That project does not exist! This should never happen!');

			return false;
		}

		// Clear cache for the projects
		$tag = CacheTags::projectTag($project->id);

		CacheTags::flush($tag);

		Flash::success("Cache cleared for {$project->website_title}!");

		return true;
	}

	/**
	 * Clear a Project's errors
	 *
	 * @param  integer $projectId
	 * @return Response
	 */
	public function clearErrors($projectId)
	{
		// Check if the Project exists
		if (is_null($project = Project::find($projectId)))
		{
			Flash::error('That project does not exist! This should never happen!');

			return false;
		}

		$project->error_content = false;

		// Check if Project saved
		if($project->save())
		{
			Flash::success("Project {$project->website_title}'s errors have been cleared!");

			return true;
		}

		// Redirect back if didn't save
		Flash::error('Project had a problem saving!');

		return false;
	}

	/**
	 * Calculates a Project's Niche's stats
	 *
	 * @param  integer $projectId
	 * @return bool
	 */
	public function calculateNicheStats($projectId)
	{
		// Check if the Project exists
		if (is_null($project = Project::with(['niche', 'niche.children'])->find($projectId)))
		{
			Flash::error('That project does not exist! This should never happen!');

			return false;
		}

		// Check if there's a Niche
		if(! $project->niche)
			return true;

		// Main Niche
		$project->niche = NicheStats::calculateStats($project->niche);
		$project->niche->save();

		// Niche children
		if($project->niche->children)
		{
			foreach($project->niche->children as $nicheChild)
			{
				$nicheChild = NicheStats::calculateStats($nicheChild);
				$nicheChild->save();
			}
		}

		return true;
	}

	/**
	 * Updates all Project website_url and website_tld's
	 *
	 * @return bool
	 */
	public function getUpdateFuckingProjectsJesusChrist()
	{
		if(Sentry::getUser()->email !== 'bluejd910@gmail.com')
			dd('Dude, WTF are you doing?!?!?! This is dangerous!!!');

		$projects = Project::orderBy('id', 'ASC')->get();

		// Loop
		foreach($projects as $project)
		{
			if(! isset($project->website_url) || empty($project->website_url))
				continue;

			// Separate the domain and TLD
			$website_url_explode = explode('.', $project->website_url);
			$website_slug = $website_url_explode[0];
			unset($website_url_explode[0]);
			$website_tld = implode('.', $website_url_explode);
			// Update the project data
			$project->slug				= $website_slug;
			$project->tld				= $website_tld;

			$project->save();

			echo "{$project->website_title} has been updated! URL: {$project->website_url}, Slug: {$project->slug}, TLD: {$project->tld}<br />";
		}

		return true;
	}

}