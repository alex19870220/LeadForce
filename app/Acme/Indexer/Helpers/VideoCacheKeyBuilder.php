<?php namespace Acme\Indexer\Helpers;

use Cache;
use City;
use Laracasts\Commander\Events\EventGenerator;
use Niche;
use Page;
use Project;
use State;

class VideoCacheKeyBuilder {

	use EventGenerator;

	protected $project;

	protected $niches;

	/*
	 * Video Lists
	 */
	protected $mainVideoList = [];
	protected $videoList     = [];

	/*
	 * Cache Key
	 */
	protected $key = 'video';

	/*
	 * Cache List
	 */
	protected $list = [];

	/**
	 * Instantiate the object and grab the Project model
	 *
	 * @param int $project_id
	 */
	function __construct($project_id)
	{
		$this->project = Project::whereId($project_id)->with([
			'niche' => function($q) {
				$q->select(['id', 'slug', 'keyword_main']);
				},
			'niche.videos',
			'niche.children' => function($q) {
				$q->select(['id', 'parent_id', 'slug', 'keyword_main']);
				},
			'niche.children.videos',
			'indexer',
			])->findOrFail($project_id);
	}

	/*
	|--------------------------------------------------------------------------
	| Meat Grinding Functions
	|--------------------------------------------------------------------------
	*/

	/**
	 * Static function to grab all project URLs
	 *
	 * @param  int $project_id
	 * @return array $list
	 */
	public static function setVideoCacheKeys($project_id)
	{
		// Give us some time & energy
		ini_set('max_execution_time', 600);
		ini_set('memory_limit','1024M');

		$obj = new static($project_id);

		// Grab Project & its Niches
		$project = $obj->project;
		$indexer_id = $project->indexer->id;

		// Grab State/City/Niche Video cache list
		$videoCacheList = $obj->getVideoCacheKeys();

		// Cache the Video Cache list
		if(is_array($videoCacheList) && count($videoCacheList) > 5)
		{
			$sitemap = new VideoSitemapBuilder($project->id);

			foreach($videoCacheList as $item)
			{
				// Cache
				Cache::forever($item['key'], $item['video']);

				// Insert into sitemap
				$sitemap->add($item['url'], $item['video'], $item['pageTitle']);
			}

			$sitemap->generate();

			return $obj;
		}
			else
		{
			// Raise event - There's no videos to use!
			$obj->raise(new NotEnoughVideos($indexer_id));
			return $obj;
		}

	}

	/**
	 * Cache all videos paired with their respective:
	 * - State
	 * - City
	 * - Niche
	 *
	 * @return array $list
	 */
	public function getVideoCacheKeys()
	{
		$project = $this->project;

		$keyword = $project->niche->keyword_main;

		// Generate all of the video URLs
		$this->buildVideoList();

		$list = [];

		/*
		 * States
		 */
		foreach($this->grabStates()->get() as $state)
		{
			$stateKey = $state->cacheKey($project->id, $this->key);
			$stateAbbr = strtoupper($state->abbr);

			$list[] = [
				'key'		=> $stateKey,
				'video'		=> $this->randomMainVideo(),
				'url'		=> route('project/state', [$project->slug, $project->tld, $state->abbr]),
				'pageTitle'	=> "{$state->state} {$keyword}"
				];

			$cities = $state->cities;

			/*
			 * Cities
			 */
			foreach($cities as $city)
			{
				$cityKey = $city->cacheKey($project->id, $state->id, $this->key);

				$list[] = [
					'key'	=> $cityKey,
					'video'	=> $this->randomMainVideo(),
					'url'	=> route('project/city', [$project->slug, $project->tld, $state->abbr, $city->slug]),
					'pageTitle'	=> "{$city->city} {$stateAbbr} {$keyword}"
					];

				/*
				 * Niches
				 */
				foreach($this->project->niche->children as $niche)
				{
					$nicheKey = $niche->cacheKey($project->id, $state->id, $city->id, $this->key);

					$list[] = [
						'key'	=> $nicheKey,
						'video'	=> $this->randomMainVideo(),
						'url'	=> route('project/niche', [$project->slug, $project->tld, $state->abbr, $city->slug, $niche->slug]),
						'pageTitle'	=> "{$city->city} {$stateAbbr} {$niche->keyword_main}"
						];

				} // End Niche

			} // End City

		} // End State

		return $list;
	}

	/*
	|--------------------------------------------------------------------------
	| Video Functions
	|--------------------------------------------------------------------------
	*/

	/**
	 * Return random Video from Niche Children
	 *
	 * @param  int $niche_id
	 * @return string
	 */
	public function randomVideo($niche_id = null)
	{
		if($niche_id == null) return $this->randomMainVideo();

		$videoList = $this->videoList[$niche_id];

		if(count($videoList) > 1)
		{
			return $videoList[ mt_rand(0, count($videoList)-1) ];
		}
			else
		{
			return null;
		}
	}

	/**
	 * Return a Main Video
	 *
	 * @return string
	 */
	public function randomMainVideo()
	{
		$videoList = $this->mainVideoList;

		if(count($videoList) > 1)
		{
			return $videoList[ mt_rand(0, count($videoList)-1) ];
		}
			else
		{
			return null;
		}
	}

	/**
	 * Generate Main Niche and Niche Children videos
	 */
	public function buildVideoList()
	{
		// Main Video List
		$videosMain = $this->project->niche->videos->first()->toArray();
		$this->mainVideoList = $videosMain['videos'];

		// Niches Video List
		foreach($this->project->niche->children as $niche)
		{
			if(! $niche->videos->first())
				continue;

			// Get video array
			$videos = $niche->videos->first()->toArray();

			// Set Video array
			if(count($videos['videos']) > 1)
			{
				$this->videoList[$niche->id] = $videos['videos'];
			}
		}

		return true;
	}

	/*
	|--------------------------------------------------------------------------
	| Location Data Collectors
	|--------------------------------------------------------------------------
	*/

	/**
	 * Grab all State with City models & return them
	 *
	 * @return State
	 */
	public function grabStates($stateId = null)
	{
		$states = State::with([
			'cities' => function($q) {
				$q->addSelect('id', 'city', 'state_id', 'slug');
			}
			])->remember(1440)->orderBy('state');
			// ])->orderBy('state');

		if($stateId !== null) $states = $states->where('id', '=', $stateId);

		return $states;
	}

	/**
	 * Grab all page URLs
	 *
	 * @return array $list
	 */
	public function grabPagesList()
	{
		if(! $this->project) return false;
		$project = $this->project;

		$pages = Page::where('project_id', $project->id)->remember(60)->whereActive(true)->orderBy('title', 'ASC')->get();

		$list = [];

		// Loop each page & set: $page->id => URL
		foreach($pages as $page)
		{
			$pageKey = $page->cacheKey($project->id, $this->key);

			$list[] = [
					'key'	=> $pageKey,
					'video'	=> $this->randomMainVideo(),
					'url'	=> route('project/page', [$project->slug, $project->tld, $page->slug]),
					'pageTitle'	=> "$page->title"
				];
		}

		return $list;
	}

}