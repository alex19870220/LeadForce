<?php namespace Acme\Indexer\Services;

interface IndexerServiceInterface {

	/**
	 * Sets the API key
	 *
	 * @param string $apiKey
	 */
	public function setApiKey($apiKey);

	/**
	 * Sets the array of URLs
	 *
	 * @param array $urlList
	 */
	public function setUrlList($urlList);

	/**
	 * Pushes an array of links to the Indexer service
	 *
	 * @param  array  $links
	 * @param  integer $days the number of days to drip the $links for
	 * @return bool
	 */
	public function push($days = null);
}