<?php namespace Acme\Sitemaps\Helpers;

use Acme\Sitemaps\Events\SitemapWasRebuilt;
use Acme\Sitemaps\Events\SitemapsWerePinged;
use App;
use City;
use Config;
use File;
use Laracasts\Commander\Events\EventGenerator;
use Page;
use Project;
use Response;
use State;

class SitemapBuilder {

	use EventGenerator;

	/**
	 * @var Project
	 */
	protected $project;

	/**
	 * @var States
	 */
	protected $states;

	/**
	 * @var Cities
	 */
	protected $cities;

	/**
	 * @var Niches
	 */
	protected $niches;

	/**
	 * Path to the sitemap
	 * @var string
	 */
	protected $path;

	/**
	 * Filename to base indexes off of
	 *
	 * @var string
	 */
	protected $filename;

	/**
	 * Project's base URL
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * URL to Project's sitemap index
	 *
	 * @var string
	 */
	// protected $urlIndex;

	/**
	 * Split large Sitemaps into multiple pages
	 *
	 * @var integer
	 */
	protected $perPage = 2000;

	/**
	 * Array of all index URLs
	 *
	 * @var array
	 */
	protected $indexUrls = [];

	/**
	 * Instantiate the object
	 *
	 * @param integer $project_id
	 */
	function __construct($project_id)
	{
		$this->project  = Project::remember(Config::get('acme.cache.project'))->with([
			'niche' => function($q) {
				$q->select(['id', 'slug']);
				},
			'niche.children' => function($q) {
				$q->select(['id', 'parent_id', 'slug']);
				},
			])->find($project_id);
		$this->path     = Config::get('acme.dir.sitemap') . "/sitemaps/{$this->project->id}";
		$this->filename = "{$this->project->id}-";
		$this->url      = $this->project->present()->homeUrl . '/';
		$this->perPage	= Config::get('acme.sitemaps.perpage');
		// $this->urlIndex = 'http://' . $this->project->website_url . '/sitemap_index.xml';
	}

	/*
	|--------------------------------------------------------------------------
	| Sitemap Builders
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Project Pages sitemap
	 *
	 * @return boolean
	 */
	public function rebuildPages()
	{
		// Create sitemap
		$sitemap = App::make('sitemap');

		// Add default pages
		$sitemap->add(route('project/home', [$this->project->slug, $this->project->tld]), null, '1', 'daily');
		$sitemap->add(route('browse/states', [$this->project->slug, $this->project->tld]), null, '0.8', 'daily');
		$sitemap->add(route('project/about-us', [$this->project->slug, $this->project->tld]), null, '0.8', 'daily');
		$sitemap->add(route('project/contact-us', [$this->project->slug, $this->project->tld]), null, '0.5', 'weekly');
		$sitemap->add(route('project/privacy', [$this->project->slug, $this->project->tld]), null, '0.2', 'monthly');
		$sitemap->add(route('project/tos', [$this->project->slug, $this->project->tld]), null, '0.2', 'monthly');
		$sitemap->add(route('project/disclaimer', [$this->project->slug, $this->project->tld]), null, '0.2', 'monthly');
		$sitemap->add(route('project/earnings-disclaimer', [$this->project->slug, $this->project->tld]), null, '0.2', 'monthly');

		$pages = Page::remember(Config::get('acme.cache.pages'))
			->whereActive(true)
			->where('project_id', '=', $this->project->id)
			->orderBy('title', 'ASC')->get(['slug', 'updated_at']);

		// Loop through the states
		foreach($pages as $page)
		{
			$sitemap->add(route('project/page', [$this->project->slug, $this->project->tld, $page->slug]), $page->updated_at, '0.7', 'weekly');
		}

		// sitemap-nc-index.xml
		$xmldata = $sitemap->generate('xml');

		$filename = 'sitemap-pages';
		$this->createFile($filename, $xmldata['content']);
		$this->indexUrls[] = $filename;
	}

	/**
	 * States Index
	 *
	 * @return boolean
	 */
	public function rebuildStates()
	{
		// Create sitemap
		$sitemap = App::make("sitemap");

		// States
		$states = State::orderBy('state', 'ASC')->remember(Config::get('acme.cache.geo'))->get(['state', 'abbr', 'slug']);

		// Loop states
		foreach($states as $state)
		{
			$sitemap->add(route('project/state', [$this->project->slug, $this->project->tld, $state->abbr]), null, Config::get('acme.sitemaps.priorities.state'), 'weekly');
		}

		$xmldata	= $sitemap->generate('xml');
		$filename	= 'sitemap-states';
		$this->createFile($filename, $xmldata['content']);
		$this->indexUrls[] = $filename;
	}

	/**
	 * State Cities sitemaps & Index
	 *
	 * @return boolean
	 */
	public function rebuildStateCities()
	{
		// States
		$states = State::remember(Config::get('acme.cache.geo'))->orderBy('state', 'ASC')->get(['id', 'abbr']);

		// Super sitemap
		// $superSitemap = App::make("sitemap");

		// Loop states
		foreach($states as $state)
		{
			$num = 0;
			$citiesNichesArray = [];

			// Grab the State's Cities
			$cities = City::remember(Config::get('acme.cache.geo'))->where('state_id', '=', $state->id)->orderBy('city', 'ASC')->get(['id', 'slug'])->toArray();

			// Loop City for the first items
			foreach($cities as $city)
			{
				$citiesNichesArray[] = [
					'city' => $city['slug'],
					];
			}

			// Loop each Niche and create array with all Cities + City/Niche URLs
			if($this->project->niche->children !== null)
			{
				foreach($this->project->niche->children as $niche)
				{
					// Loop City
					foreach($cities as $city)
					{
						$citiesNichesArray[] = [
							'city'  => $city['slug'],
							'niche' => $niche->slug,
							];
					}
				}
			}
			else
			// No Children
			{
				// Loop City
				foreach($cities as $city)
				{
					$citiesNichesArray[] = [
						'city'  => $city['slug'],
						'niche' => $this->project->niche->slug,
						];
				}
			}



			// Loop City + City/Niche pages
			foreach(array_chunk($citiesNichesArray, $this->perPage) as $cities)
			{
				// Create sitemap
				$sitemap = App::make("sitemap");

				// Loop City group
				foreach($cities as $city)
				{
					if(! isset($city['niche']))
					{
						$sitemap->add(route('project/city', [$this->project->slug, $this->project->tld, $state->abbr, $city['city']]), null, Config::get('acme.sitemaps.priorities.city'), 'weekly');
					}
					else
					{
						$sitemap->add(route('project/niche', [$this->project->slug, $this->project->tld, $state->abbr, $city['city'], $city['niche']]), null, Config::get('acme.sitemaps.priorities.niche'), 'weekly');
					}
				}

				// sitemap-state-nc-cities-001.xml
				$xmldata	= $sitemap->generate('xml');
				$filename	= "sitemap-cities-{$state->abbr}-" . str_pad($num, 3, '0', STR_PAD_LEFT);
				$this->createFile($filename, $xmldata['content']);
				$this->indexUrls[] = $filename;

				$num++;
			} // End City/Niche Loop
		} // End State Loop

		return $this->indexUrls;
	}

	/**
	 * sitemap.xml
	 *
	 * @return boolean
	 */
	public function rebuildIndex()
	{
		// Create sitemap
		$sitemap = App::make("sitemap");

		foreach($this->indexUrls as $index)
		{
			$sitemap->addSitemap($this->url . "{$index}.xml");
		}

		$xmldata = $sitemap->generate('sitemapindex');
		// $xmldata	= $sitemap->generate('xml');
		$this->createFile('sitemap', $xmldata['content']);
	}

	/**
	 * sitemap.xml
	 *
	 * @return boolean
	 */
	public function rebuildIndexVersionTwo()
	{
		// Create sitemap
		$sitemapIndex = App::make("sitemap");

		foreach($this->indexUrls as $index)
		{
			$sitemapIndex->addSitemap($this->url . "{$index}.xml");
		}

		$xmldata = $sitemapIndex->generate('sitemapindex');
		// $xmldata	= $sitemap->generate('xml');
		$this->createFile('sitemap', $xmldata['content']);
	}

	/*
	|--------------------------------------------------------------------------
	| Static Function
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Rebuilds the sitemap
	 *
	 * @param  integer $project_id
	 * @return string
	 */
	public static function rebuild($project_id)
	{
		// Memory! Boo yah
		ini_set('memory_limit','1024M');
		ini_set('max_execution_time', 300);

		$obj = new static($project_id);

		$obj->clearFolder();

		$obj->rebuildPages();

		$obj->rebuildStates();

		$obj->rebuildStateCities();

		$obj->rebuildIndex();

		// Fire off the CampaignWasCreated event
		$obj->raise(new SitemapWasRebuilt($project_id));

		return $obj;
	}

	/**
	 * Render the XML file to be viewed
	 *
	 * @param  string $path
	 * @return Response
	 */
	public static function render($path)
	{
		$headers = [
				'Content-type' => 'text/xml; charset=utf-8'
			];

		if(! File::exists($path))
		{
			return App::abort(404, "Sitemap {$path} doesn't exist!");
		}

		$data = File::get($path);

		return Response::make($data, 200, $headers);
	}

	/**
	 * Static function to get the path to the sitemap
	 *
	 * @param  int $project_id
	 * @return string
	 */
	public static function getPath($project_id)
	{
		$obj = new static($project_id);

		return $obj->path;
	}

	/*
	|--------------------------------------------------------------------------
	| Helpers
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Clears the Project's sitemaps before creating a new one
	 *
	 * @return boolean
	 */
	protected function clearFolder()
	{
		return File::cleanDirectory($this->path, true);
	}

	/**
	 * Creates the video sitemap file
	 *
	 * @param  string $contents
	 * @return mixed
	 */
	protected function createFile($filename, $contents)
	{
		$path = $this->path;

		if(! File::isDirectory($this->path))
		{
			File::makeDirectory($this->path, 0775);
		}

		File::put($this->path . '/' . $filename . '.xml', $contents);

		return (File::exists($this->path)) ? $this->path : null;
	}

	/**
	 * Pings search engines the given URLs
	 *
	 * @param  string $url
	 * @return boolean
	 */
	public static function ping($project_id)
	{
		$obj = new static($project_id);

		$url = $obj->url . 'sitemap.xml';

		$searchEngines = [
				"http://www.google.com/webmasters/tools/ping?sitemap={$url}",
				"http://www.bing.com/ping?sitemap={$url}",
				"http://webmaster.yandex.com/site/map.xml?host={$url}"
			];

		foreach($searchEngines as $searchEngine)
		{
			$ping = @file_get_contents($searchEngine);
		}

		return $obj;
	}
}