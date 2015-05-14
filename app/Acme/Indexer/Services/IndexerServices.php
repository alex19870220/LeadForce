<?php namespace Acme\Indexer\Services;

use Acme\Indexer\Services\Indexification;
use Acme\Indexer\Services\InstantLinkIndexer;

class IndexerServices {

	/**
	 * Instant Link Indexer API handler
	 *
	 * @param array  $urlList
	 * @param string $apiKey
	 * @param integer $days
	 */
	public static function InstantLinkIndexer(array $urlList, $apiKey, $days = null)
	{
		$InstantLinkIndexer = new InstantLinkIndexer;

		$InstantLinkIndexer->setApiKey($apiKey)->setUrlList($urlList);
		$result = $InstantLinkIndexer->push();

		if($result == 'OK')
			return true;

		return $result;
	}

	/**
	 * Indexification API handler
	 *
	 * @param array  $urlList
	 * @param string $apiKey
	 * @param integer $days
	 */
	public function Indexification(array $urlList, $apiKey, $days = null)
	{
		$InstantLinkIndexer = new Indexification;

		$InstantLinkIndexer->setApiKey($apiKey)->setUrlList($urlList);
		$result = $InstantLinkIndexer->push();

		if($result == 'OK')
			return true;

		return $result;
	}

}