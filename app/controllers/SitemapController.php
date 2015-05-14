<?php

use Acme\Sitemaps\Helpers\SitemapBuilder;

class SitemapController extends BaseController {

	/**
	 * @var State $geoStates
	 */
	protected $geoStates = null;

	/**
	 * @var Project $project
	 */
	protected $project;

	/**
	 * @var string $section
	 */
	protected $section;

	/**
	 * @var string $url
	 */
	protected $url;

	/**
	 * Instantiate the object
	 */
	public function __construct()
	{
		// Project object
		$this->project = Route::input('projectSlug');

		// Cache section
		$this->section = "sitemap:p:{$this->project->id}";

		// Get site base URL
		$this->url = $this->project->present()->homeUrl.'/';
	}

	/**
	 * Display all Sitemaps
	 *
	 * @return Response
	 */
	public function getSitemapIndex()
	{
		$path = SitemapBuilder::getPath($this->project->id) . '/sitemap' . '.xml';

		return SitemapBuilder::render($path);
	}

	/**
	 * Display sitemap
	 *
	 * @return Response
	 */
	public function getSitemap($projectSlug, $projectTld, $sitemap)
	{
		$path = SitemapBuilder::getPath($this->project->id) . '/sitemap-' . e($sitemap) . '.xml';

		return SitemapBuilder::render($path);
	}

	/*
	|--------------------------------------------------------------------------
	| Video Sitemaps
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * View video sitemap index
	 *
	 * @param  string $projectSlug
	 * @return Response
	 */
	public function getVideoSitemapIndex($projectSlug, $projectTld)
	{
		$project = $this->project;

		$path = Config::get('acme.dir.sitemap') . "/video/{$project->id}/index.xml";

		if(! File::exists($path))
		{
			App::abort(404);
		}

		$data = File::get($path);

		return Response::make($data, 200, ['Content-type' => 'text/xml; charset=utf-8']);
	}

	/**
	 * View video sitemap
	 *
	 * @param  string $projectSlug
	 * @param  string $sitemapType
	 * @param  integer $sitemapId
	 * @return Response
	 */
	public function getVideoSitemap($projectSlug, $projectTld, $sitemapId)
	{
		$project = $this->project;

		$path = Config::get('acme.dir.sitemap') . "/video/{$project->id}/{$sitemapId}.xml";

		if(! File::exists($path))
		{
			App::abort(404);
		}

		$data = File::get($path);

		return Response::make($data, 200, ['Content-type' => 'text/xml; charset=utf-8']);
	}

}