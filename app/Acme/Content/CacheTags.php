<?php namespace Acme\Content;

use Cache;

class CacheTags {

	/**
	 * Base content tag
	 *
	 * @var string
	 */
	protected $tag = 'contentTag:';

	/**
	 * State key
	 *
	 * @var string
	 */
	protected $stateKey = 's:';

	/**
	 * City key
	 *
	 * @var string
	 */
	protected $cityKey = 'c:';

	/**
	 * Niche key
	 *
	 * @var string
	 */
	protected $nicheKey = 'n:';

	/**
	 * Project key
	 *
	 * @var string
	 */
	protected $projectKey = 'p:';

	/*
	|--------------------------------------------------------------------------
	| Cache Tags
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Niche content tag
	 *
	 * @param  integer $nicheId
	 * @return string
	 */
	public function nicheTag($nicheId)
	{
		return $this->tag . $this->nicheKey . $nicheId;
	}

	/**
	 * Project content tag
	 *
	 * @param  integer $projectId
	 * @return string
	 */
	public function projectTag($projectId)
	{
		return $this->tag . $this->projectKey . $projectId;
	}

	/*
	|--------------------------------------------------------------------------
	| Flushing Caches
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Flush a cache tag
	 *
	 * @param  string $cacheTag
	 * @return bool
	 */
	public function flush($cacheTag)
	{
		return Cache::tags($cacheTag)->flush();
	}
}