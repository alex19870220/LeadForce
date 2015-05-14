<?php namespace Acme\Indexer\Services;

use Acme\Indexer\Services\IndexerServiceInterface;
use Acme\Indexer\Services\IndexerTrait;
use Carbon;
use Config;
use InvalidArgumentException;

class InstantLinkIndexer implements IndexerServiceInterface {

	use IndexerTrait;

	/**
	 * @var string $serviceName
	 */
	protected $serviceConfigName = 'acme.api.indexers.instantlinkindexer';

	protected $maxLinks = 100;

	/**
	 * Pushes an array of links to the Indexer service
	 *
	 * @param  array  $links
	 * @param  integer $days the number of days to drip the $links for
	 * @return bool
	 */
	public function push($days = null)
	{
		// API URL
		$apiUrl = $this->apiUrl;
		if(! isset($apiUrl) || empty($apiUrl))
			throw new InvalidArgumentException('The API url in the Config must be set!');

		// API Key
		$apiKey = $this->apiKey;
		if(! isset($apiKey) || empty($apiKey))
			throw new InvalidArgumentException('The API key must be set!');

		// URL List
		$urlList = $this->urlList;
		$urlList = array_map('trim', $urlList);

		// Check if URL list count is over the max
		if(count($urlList) > $this->maxLinks)
			throw new InvalidArgumentException('The number of URLs is over the limit. You tried to submit ' . count($urlList) . ' URLs!');

		// build the POST query string and join the URLs array with | (single pipe)
		$httpQuery = [
			'apikey'	=> $apiKey,
			'cmd'		=> 'submit',
			'campaign'	=> Carbon::now()->toDateTimeString(),
			'urls'		=> implode('|', $urlList),
		];

		$httpQuery = http_build_query($httpQuery);

		// Send the API query
		return $this->sendApiRequest($httpQuery);
	}
}