<?php namespace Acme\Indexer\Services;

use Config;
use InvalidArgumentException;
use Laracasts\Presenter\Exceptions\PresenterException;

trait IndexerTrait {

	/**
	 * The name of the Indexer Service
	 *
	 * @var string $serviceName
	 */
	protected $serviceName;

	/**
	 * The API Key for the server
	 *
	 * @var string $apiKey
	 */
	protected $apiKey;

	/**
	 * The URL that the request will be posted to
	 *
	 * @var string $apiUrl
	 */
	protected $apiUrl;

	/**
	 * @var array $urlList the array of URLs to be pushed to the Indexer service
	 */
	protected $urlList;

	/**
	 * Instantiate the Object
	 */
	function __construct()
	{
		// Set info/data
		$apiData = Config::get($this->serviceConfigName);

		if(empty($apiData) || ! is_array($apiData))
			throw new InvalidArgumentException("The Indexer service [{$this->serviceConfigName}] does not exist in the config!");

		// Set API name
		$this->serviceName = $apiData['name'];

		// Set API url
		$this->apiUrl = $apiData['apiurl'];

		if(! isset($this->apiUrl) || empty($this->apiUrl))
			throw new InvalidArgumentException('The API url must be set in the config!');
	}

	/**
	 * Sets the API key
	 *
	 * @param string $apiKey
	 */
	public function setApiKey($apiKey)
	{
		$this->apiKey = $apiKey;

		return $this;
	}

	/**
	 * Sets the array of URLs
	 *
	 * @param array $urlList
	 */
	public function setUrlList($urlList)
	{
		if(! is_array($urlList) || empty($urlList))
			throw new InvalidArgumentException('The URL list must be an array!');

		$this->urlList = $urlList;

		return $this;
	}

	/**
	 * Sends an API request using post Curl
	 *
	 * @param  string $apiUrl
	 * @param  string $httpQuery
	 * @return mixed
	 */
	public function sendApiRequest($httpQuery)
	{
		// Do the API Request using CURL functions
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 40);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $httpQuery);

		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

}