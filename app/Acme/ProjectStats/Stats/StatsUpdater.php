<?php namespace Acme\ProjectStats\Stats;

use Acme\Scraper\GoogleScraper;
use Carbon;
use Config;
use Laracasts\Commander\Events\EventGenerator;
use Project;
use ProjectStats;

class StatsUpdater {

	use EventGenerator;

	/**
	 * @var array $urls
	 */
	protected $urls = [];

	/**
	 * The amount of seconds ProjectStats must wait before being updated again
	 *
	 * @var integer $updateTimeout
	 */
	protected $updateTimeout = 3600;

	/**
	 * Gets the Index count three times and keeps the best number
	 *
	 * @var integer $indexCountBestOf
	 */
	protected $indexCountBestOf = 3;

	/**
	 * If the new Index Count is less than this percent of the current Index Count, then ignore the new number
	 *
	 * @var float
	 */
	protected $indexPercentFailSafe = 0.30;

	/**
	 * Times to use the Index Count failsafe
	 *
	 * @var integer
	 */
	protected $indexPercentFailSafeTries = 5;

	/*
	|--------------------------------------------------------------------------
	| Update All Stats
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Updates the stats of either all projects or just one
	 *
	 * @param  integer $userId
	 * @return array $results
	 */
	public function updateAllProjectStats($userId)
	{
		$projects = $this->getprojects($userId);

		// Loop the projects
		foreach($projects as $project)
		{
			$projectStats = $this->updateProjectStats($project);
		}

		return $this;
	}

	/**
	 * Update a single Project's stats
	 *
	 * @param  Project $project
	 * @return ProjectStats
	 */
	public function updateProjectStats(Project $project)
	{
		// Get ProjectStats from today or create new one
		$projectStats = $this->getProjectStatsModel($project->id);

		// Skip if updated recently
		if(! $projectStats)
			return false;

		// Project URL
		$url = str_replace('.dev', '.com', $project->website_url);

		// Calculate page count
		$pageCount = $this->calcTotalPages($project->id);

		// Get the last update timestamp
		$projectStatsLastUpdate = (! isset($projectStats->updated_at)) ? 0 : $projectStats->updated_at->timestamp;

		// Collect stats on timeouts
		if($projectStatsLastUpdate < (time() - $this->updateTimeout))
		{
			// Index Count
			$projectStats = $this->processIndexCount($projectStats, $url);
		}

		// Page Count
		$projectStats->page_count = $pageCount;
		$projectStats->save();

		return $projectStats;
	}

	/*
	|--------------------------------------------------------------------------
	| Individual Stats Methods
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Processes the Index Count, including failsafes, etc
	 *
	 * @param  ProjectStats $projectStats
	 * @param  string       $url
	 * @return ProjectStats $projectStats
	 */
	public function processIndexCount(ProjectStats $projectStats, $url)
	{
		$indexCount = $this->getBestIndexCount($url);

		// Index Count with FailSafe
		if($projectStats->index_count > 0 && $projectStats->tries_index_count <= $this->indexPercentFailSafeTries)
		{
			// Calculate the threshold
			$indexCountFailSafe = ($projectStats->index_count * $this->indexPercentFailSafe);

			if($indexCount > $indexCountFailSafe)
			{
				$projectStats->index_count = $indexCount;
				$projectStats->tries_index_count = 1;
			}
			else
			{
				$projectStats->tries_index_count++;
			}
		}
		else
		{
			$projectStats->index_count			= $indexCount;
			$projectStats->tries_index_count	= 1;
		}

		return $projectStats;
	}

	/**
	 * Gets the Index Count of a URL from the max of multiple tries
	 *
	 * @param  string $url
	 * @return integer
	 */
	public function getBestIndexCount($url)
	{
		$results = GoogleScraper::scrapeIndexCount(['site:' . $url], $this->indexCountBestOf);
		// echo '<pre>' . print_r($results) . '</pre>';
		$results = array_pluck($results, 'results');

		if(is_array($results) && count($results) > 0)
			return max($results);

		return false;
	}

	/**
	 * Calculate the total number of pages for a Project
	 *
	 * @param  integer $projectId
	 * @return integer
	 */
	public function calcTotalPages($projectId)
	{
		// Calculate number of pages
		$cities = Config::get('acme.geo.citycount');
		$states = Config::get('acme.geo.statecount');
		$defpages = Config::get('acme.geo.defaultpages');

		$project = Project::with([
			'niche' => function($q) {
				$q->addSelect('id');
			},
			'niche.children' => function($q) {
				$q->addSelect('id', 'parent_id');
			},
			])->find($projectId);

		// First niche
		$niche_count = 1;

		// If Project has niche->children, then count them
		if(isset($project->niche->children))
		{
			$niche_count = $project->niche->children->count() + $niche_count;
		}

		return (($cities * $niche_count) + $states + $defpages);
	}

	/*
	|--------------------------------------------------------------------------
	| Project Data
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns all Project URLs
	 *
	 * @param  integer $userId
	 * @return array
	 */
	protected function getprojects($userId)
	{
		return Project::where('created_by', '=', $userId)
			->orderBy('id', 'DESC')
			->select(['id', 'website_url'])
			->limit(20)
			->get();
	}

	/**
	 * Grabs either today's ProjectStats for a Project, or creates a new one
	 *
	 * @param  integer $projectId
	 * @return ProjectStats
	 */
	protected function getProjectStatsModel($projectId)
	{
		// Last stats update
		$projectStats = ProjectStats::where('project_id', '=', $projectId)
			->orderBy('id', 'DESC')
			->first();

		// If there is recent ProjectStats
		if(count($projectStats) == 0 || $projectStats->created_at->timestamp < Carbon::today()->timestamp)
		{
			$projectStats = new ProjectStats;
			$projectStats->project_id = $projectId;

			return $projectStats;
		}

		return $projectStats;
	}
}