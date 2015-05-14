<?php

use Acme\Indexer\CreateCampaignCommand;
use Acme\Indexer\UpdateCampaignStatusCommand;
use Acme\Indexer\SubmitUrlsToIndexerServiceCommand;
use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\Events\EventGenerator;

class IndexerController extends AdminController {

	use CommanderTrait;

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get Indexing dashboard
	 *
	 * @return Response
	 */
	public function getDashboard()
	{
		// Grab all the Indexer Campaigns
		$campaigns = Indexer::with([
			'project',
			'project.niche',
			'videos',
			'project.stats' => function($q)
			{
				$q->orderBy('id', 'DESC');
			}])
			->leftJoin('projects', 'indexer_campaigns.project_id', '=', 'projects.id')
			->where('projects.created_by', '=', Sentry::getUser()->id)
			->orderBy('indexer_campaigns.created_at', 'DESC');

		// Do we want to include the finished campaigns?
		if (Input::get('withFinished') || ! Input::get())
		{
			// $campaigns = $campaigns->all();
		}
		elseif (Input::get('onlyActive'))
		{
			$campaigns = $campaigns->active();
		}
		elseif (Input::get('onlyFinished'))
		{
			$campaigns = $campaigns->inactive();
		}

		// Paginate the pages
		$campaigns = $campaigns->select([
			'indexer_campaigns.id',
			'indexer_campaigns.project_id',
			'indexer_campaigns.status',
			'indexer_campaigns.active',
			'indexer_campaigns.complete',
			'indexer_campaigns.created_at',
			])
			->get();

		// Projects array for create new Indexer
		$projects = Project::leftJoin('indexer_campaigns', function($j) {
				$j->on('projects.id', '=', 'indexer_campaigns.project_id');
			})
			->whereNull('indexer_campaigns.project_id')
			->where('projects.created_by', '=', Sentry::getUser()->id)
			->orderBy('website_title', 'ASC')->get(['projects.id', 'website_title']);

		return View::make('backend.indexer.dashboard', compact('campaigns', 'projects'));
	}

	/**
	 * Publish the new Indexing campaign
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->execute(CreateCampaignCommand::class);

		Flash::success('New indexing campaign created!');

		return Redirect::route('indexer');
	}

	/**
	 * View the Indexer settings
	 *
	 * @return Response
	 */
	public function getSettings()
	{
		return View::make('backend.indexer.settings');
	}

	/**
	 * Update the Indexer settings
	 *
	 * @return Response
	 */
	public function postSettings()
	{
		return View::make('backend.indexer.settings');
	}

	/**
	 * Preview all pages for a Project
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function getViewProjectPages($id)
	{
		$pages = PageLister::getPages($id);

		return View::make('backend.indexer.view-project-pages', compact('pages'));
	}

	/**
	 * Delete an Indexer campaign
	 *
	 * @param  integer $campaignId
	 * @return Response
	 */
	public function getDelete($campaignId)
	{
		// Check if the category category exists
		if (is_null($campaign = Indexer::find($campaignId)))
		{
			Flash::error('Indexer campaign not found...?');

			// Redirect to the indexer management page
			return Redirect::to('indexer');
		}

		// Delete the category category
		$campaign->delete();

		Flash::success('Indexer campaign has been deleted!');

		// Redirect to the category categories management page
		return Redirect::route('indexer');
	}

	/*
	|--------------------------------------------------------------------------
	| One-Click Actions
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Start indexing
	 *
	 * @param  int $campaign_id
	 * @return Redirect
	 */
	public function postStartIndexing($campaign_id)
	{
		$indexer = Indexer::findOrFail($campaign_id);

		$project_id = $indexer->project->id;

		// Rebuild sitemap
		Queue::push('Acme\Sitemaps\Queues\QueueRebuildSitemap', ['project_id' => $project_id]);

		// Rebuild video sitemap
		Queue::push('Acme\Indexer\Queues\QueueCompleteIndexer', ['campaign_id' => $campaign_id, 'project_id' => $project_id]);

		$this->execute(UpdateCampaignStatusCommand::class, ['campaign_id' => $campaign_id]);

		Flash::success('Indexer campaign has been queued and will begin shortly!');

		return Redirect::route('indexer');
	}

	/**
	 * Stop indexing
	 *
	 * @param  int $campaign_id
	 * @return Redirect
	 */
	public function postStopIndexing($campaign_id)
	{
		$this->execute(UpdateCampaignStatusCommand::class, ['campaign_id' => $campaign_id]);

		Flash::success('Indexer campaign has been stopped.');

		return Redirect::route('indexer');
	}


	/**
	 * Manually scrape Video ID's
	 *
	 * @var	int $campaign_id
	 * @return Redirect
	 */
	public function getStartScraping($campaign_id)
	{
		// Push the job into the Queue
		Queue::push('Acme\Indexer\Queues\QueueVideoScraper', ['campaign_id' => $campaign_id]);

		Flash::success("Scraping videos for project!");

		return Redirect::route('indexer');
	}

	/**
	 * Rebuilds the regular sitemap
	 *
	 * @param  integer $project_id
	 * @return Redirect
	 */
	public function getRebuildSitemap($projectId)
	{
		// Rebuild sitemap
		Queue::push('Acme\Sitemaps\Queues\QueueRebuildSitemap', ['project_id' => $projectId]);

		Flash::success('The sitemap is being rebuilt then pinged to all search engines!');

		return Redirect::route('indexer');
	}

	/**
	 * Generates all URLs, resets the Videos for each URL, then builds the sitemap
	 *
	 * @param  integer $project_id
	 * @return Redirect
	 */
	public function getRebuildVideoSitemap($project_id)
	{
		// Push the job into the Queue
		Queue::push('Acme\Indexer\Queues\QueueRebuildSitemap', ['project_id' => $project_id]);

		Flash::success('The video sitemap is being rebuilt then pinged to all search engines!');

		return Redirect::route('indexer');
	}

	/**
	 * Ping Google/Bing/Yandex with the URL of the sitemap
	 *
	 * @param  integer $project_id
	 * @return Redirect
	 */
	public function getPingSitemap($project_id)
	{
		// Push the job into the Queue
		Queue::push('Acme\Sitemaps\Queues\QueuePingSitemaps', ['project_id' => $project_id]);

		Flash::success('Ping!');

		return Redirect::route('indexer');
	}

	/**
	 * Queue updating all Project Stats data
	 *
	 * @param  integer $project_id
	 * @return Response
	 */
	public function getUpdateProjectStats()
	{
		// Push the job into the Queue
		Queue::push('Acme\ProjectStats\Queues\QueueUpdateStats', ['userId' => Sentry::getUser()->id]);

		Flash::success('Project stats queued for updating!');

		return Redirect::route('indexer');
	}

	public function getSubmitLinksToIndexerService($projectId)
	{
		if(! Request::ajax())
			return false;

		if (is_null($project = Project::findOrFail($projectId)))
		{
			return false;
		}

		// Get the user's inputted indexer services
		$userIndexerServices = Sentry::getUser()->getOption('indexers');

		return View::make('backend.modals.indexer-services', compact('project', 'userIndexerServices'));
	}

	/**
	 * Submit Project URLs to Indexing services
	 *
	 * @param  integer $projectId
	 * @return Response
	 */
	public function postSubmitLinksToIndexerService($projectId)
	{
		$project = Project::findOrFail($projectId);
		$indexerService = Input::get('indexer_service');
		$apiKey = Sentry::getUser()->getOption('indexers.' . $indexerService . '.apikey');
		$urlsToSubmit = Input::get('urls_to_submit');

		$this->execute(SubmitUrlsToIndexerServiceCommand::class, ['projectId' => $project->id, 'urlsToSubmit' => $urlsToSubmit, 'indexerService' => $indexerService, 'apiKey' => $apiKey]);

		Flash::success("{$project->label}'s URLs submitted to Indexing service(s)!");

		return Redirect::route('indexer');
	}

}