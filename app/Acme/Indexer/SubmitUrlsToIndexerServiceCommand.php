<?php namespace Acme\Indexer;

class SubmitUrlsToIndexerServiceCommand {

	/**
	 * @var integer $projectId
	 */
	public $projectId;

	/**
	 * @var string $indexerService
	 */
	public $indexerService;

	/**
	 * @var string $apiKey
	 */
	public $apiKey;

	/**
	 * @var array $urlsToSubmit
	 */
	public $urlsToSubmit;

	/**
	 * @var array $urlList
	 */
	public $urlList;

	/**
	 * Instantiate the Object
	 *
	 * @param string $indexerService
	 * @param string $apiKey
	 * @param array $urlList
	 */
	function __construct($projectId, $urlsToSubmit, $indexerService, $apiKey, $urlList = [])
	{
		$this->projectId		= $projectId;
		$this->indexerService	= $indexerService;
		$this->apiKey			= $apiKey;
		$this->urlsToSubmit		= $urlsToSubmit;
		$this->urlList			= $urlList;
	}


}