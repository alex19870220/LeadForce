<?php namespace Acme\Content;

use Cache;
use CacheTags;
//use Clockwork;
use Config;
use Route;
use Shortcodes;
use Spinner;

class ContentHandler {

	/**
	 * @var string $content
	 */
	protected $content;

	/**
	 * @var string $spintax
	 */
	protected $spintax;

	/**
	 * @var string $contentKeyKey
	 */
	protected $contentKeyKey = 'content';

	/**
	 * @var string $contentKey
	 */
	protected $contentKey;

	/**
	 * @var string $nicheTag
	 */
	protected $nicheTag;

	/**
	 * @var string $projectTag
	 */
	protected $projectTag;

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		$project	= Route::input('projectSlug');
		$niche		= Route::input('nicheSlug');
		$state		= Route::input('st');
		$city		= Route::input('city');

		// If Niche is null, use Project's Niche
		if($niche == null)
			$niche = $project->niche;

		// If State is null, check other Route parameter
		if($state == null)
			Route::input('stateSlug');

		// Tag and key for Redis cache
		if($project !== null && $niche !== null && $state !== null && $city !== null)
			$this->contentKey		= $niche->cacheKey($project->id, $state->id, $city->id, $this->contentKeyKey);

		if($project !== null)
			$this->projectTag		= CacheTags::projectTag($project->id);

		if($niche !== null)
			$this->nicheTag			= CacheTags::nicheTag($niche->id);
	}

	/*
	|--------------------------------------------------------------------------
	| Content Processing
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * The method to run all the classes through the content
	 *
	 * @param  string $content
	 * @return string
	 */
	public function processContent($content = '')
	{
		// Clockwork::startEvent('content_processing', 'Processing content');

		// Parse shortcodes
		$content = Shortcodes::process($content);

		// Parse spintax, catch errors
		$content = Spinner::parse($content);

		// Get content path
		$contentPath = $this->getCachedContentPath();

		// dd($contentPath);

		// Generate the content from the path
		try
		{
			$output = Spinner::getSpunText($contentPath);
		}
		catch (\ErrorException $e)
		{
			// Flag the error
			$project = Route::input('projectSlug');
			$project->error_content = true;
			$project->save();

			$output = 'Error parsing the content!';
		}

		// Clockwork::endEvent('content_processing');

		return $output;
	}

	/**
	 * Gets the Cached Content Path or generates a new one
	 *
	 * @return array $path
	 */
	public function getCachedContentPath()
	{
		// dd("niche: {$this->nicheTag} project: {$this->projectTag}");

		// Check if a path is already cached
		if(Config::get('acme.cache.content.enabled'))
		{
			$cacheKey = $this->contentKey;

			if(Cache::tags($this->nicheTag, $this->projectTag)->has($cacheKey))
				return Cache::tags($this->nicheTag, $this->projectTag)->get($cacheKey);

			$spintaxPath = Spinner::generatePath();

			// dd($cacheKey);

			Cache::tags($this->nicheTag, $this->projectTag)->forever($cacheKey, $spintaxPath);

			return $spintaxPath;
		}

		return [];
	}

	/*
	|--------------------------------------------------------------------------
	| Cache Key Content Processing
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Process cached, spun content by cache keys
	 *
	 * @param  string $content
	 * @param  string $cacheKey
	 * @return string
	 */
	public function processCacheKeyContent($content = '', $cacheKey)
	{
		// Parse shortcodes
		$content = Shortcodes::process($content);

		// Parse spintax, catch errors
		$content = Spinner::parse($content);

		// Get content path
		$contentPath = $this->getCacheKeyContentPath($cacheKey);

		// Generate the content from the path
		try
		{
			$output = Spinner::getSpunText($contentPath);
		}
		catch (\ErrorException $e)
		{
			$output = 'Error parsing the content!';
		}

		return $output;
	}

	/**
	 * Get a cached content path by cache key
	 *
	 * @param  string $cacheKey
	 * @return string
	 */
	public function getCacheKeyContentPath($cacheKey)
	{
		// Check if a path is already cached
		if(Config::get('acme.cache.content.enabled') && ! empty($cacheKey))
		{
			if(Cache::has($cacheKey))
				return Cache::get($cacheKey);

			$spintaxPath = Spinner::generatePath();

			Cache::forever($cacheKey, $spintaxPath);

			return $spintaxPath;
		}

		return [];
	}

	/*
	|--------------------------------------------------------------------------
	| Old Spinners
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Tests the parsing speed of the new & old spinners
	 *
	 * @return array
	 */
	public function testSpinners()
	{
		$content			= $this->content;
		$cycles				= 100000;
		$times['cycles']	= $cycles;

		// New spinner
		$begin = microtime(true);
		for($x = 0;$x < $cycles;$x++)
		{
			// Parse Spintax
			$content = Spinner::spin($content);
		}
		$times['new spinner'] = microtime(true) - $begin;

		// Old spinner
		$begin = microtime(true);
		for($x = 0;$x < $cycles;$x++)
		{
			// Parse Spintax
			$content = Spinner::oldSpin($content);
		}
		$times['old spinner'] = microtime(true) - $begin;
		$times['cycles'] = number_format($times['cycles']);

		return $times;
	}

	/**
	 * Process the content in chunks *beta*
	 *
	 * @param  string $content
	 * @return string $content
	 */
	public function processContentInChunks($content = '')
	{
		// Parse shortcodes then spin
		$content = Shortcodes::process($content);

		// Break content into chunks & process 1 at a time
		$content = explode(PHP_EOL, $content);

		for($x = 0;$x < count($content);$x++)
		{
			$content[$x] = Spinner::parse($content[$x]);

			// Get content path
			$contentPath = $this->getCachedContentPath($x);

			// Generate the content from the path
			$content[$x] = Spinner::getSpunText($contentPath);
		}

		return implode(PHP_EOL, $content);
	}

	/*
	|--------------------------------------------------------------------------
	| Cache
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	public function flushNicheCache($projectId, $nicheId)
	{
		$niche = Niche::find($nicheId)->firstOrFail();
		// Flush cache tags... works!
		Cache::tags($niche->cacheTag($project_id))->flush();
	}

}