<?php namespace Acme\Piwik;

use Config;
use Acme\Piwik\Piwik;

class PiwikStats {

	/**
	 * Piwik API wrapper
	 *
	 * @var Piwik $piwik
	 */
	protected $piwik;

	/**
	 * Instantiates the Piwik API for the given site ID
	 *
	 * @param  string $siteId
	 * @return bool
	 */
	public function getPiwikApi($siteId = 'all')
	{
		$this->piwik = new Piwik(Config::get('acme.api.piwik.url'), Config::get('acme.api.piwik.token'), $siteId, Piwik::FORMAT_JSON);

		return $this;
	}

	/**
	 * Get site information by ID
	 *
	 * @param  integer $siteId
	 * @return array
	 */
	public function getSiteInfo($siteId)
	{
		$piwik = $this->getPiwikApi($siteId);

		return $piwik->piwik->getSiteInformation();
	}

	/**
	 * Returns all sites set up on Piwik
	 *
	 * @return StdClass
	 */
	public function getAllSites()
	{
		$piwik = $this->getPiwikApi();

		return $piwik->piwik->getAllSites();
	}

	/*
	|--------------------------------------------------------------------------
	| Visitor Stats
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Get site stats by ID - default is last 7 days
	 *
	 * @param  integer $siteId
	 * @param  Piwik $period
	 * @param  Piwik $date
	 * @return PiwikStats
	 */
	public function getSiteStats($siteId, $period = Piwik::PERIOD_DAY, $date = 'last7', $rangeStart = '', $rangeEnd = null)
	{
		$this->getPiwikApi($siteId);

		// Set period & date
		$this->setPeriod($period);
		$this->setDate($date);
		// $this->setRange($rangeStart, $rangeEnd = null);

		return $this;
	}

	/**
	 * Sets the stats Period
	 *
	 * @param Piwik $period
	 */
	public function setPeriod($period = Piwik::PERIOD_DAY)
	{
		$this->piwik->setPeriod($period);

		return $this;
	}

	/**
	 * Sets the stats Date
	 *
	 * @param Piwik $date
	 */
	public function setDate($date = 'last7')
	{
		$this->piwik->setDate($date);

		return $this;
	}

	public function setRange($rangeStart, $rangeEnd = null)
	{
		$this->piwik->setRange($rangeStart, $rangeEnd = null);

		return $this;
	}

	/**
	 * Returns unique visitors
	 *
	 * @return StdClass
	 */
	public function getUniqueVisitors()
	{
		return $this->piwik->getUniqueVisitors();
	}

	/**
	 * Returns visits
	 *
	 * @return StdClass
	 */
	public function getVisits()
	{
		return $this->piwik->getVisits();
	}

	/**
	 * Returns conversions
	 *
	 * @return StdClass
	 */
	public function getConversions()
	{
		return $this->piwik->getVisitsConverted();
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
	 * Combine the array of numbers for the Piwik Site stats
	 *
	 * @param  stdClass $object
	 * @return integer
	 */
	public function combineStats($object)
	{
		if(is_object($object))
			$object = (array) $object;

		return array_sum($object);
	}

	/*
	|--------------------------------------------------------------------------
	| Add / Update / Delete site functions
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Adds a website to Piwik
	 *
	 * @param  string $siteName
	 * @param  string $url
	 * @param  string $ecommerce
	 * @param  string $siteSearch
	 * @param  string $searchKeywordParameters
	 * @param  string $searchCategoryParameters
	 * @param  string $excludeIps
	 * @param  string $excludedQueryParameters
	 * @param  string $timezone
	 * @param  string $currency
	 * @param  string $group
	 * @param  string $startDate
	 * @return integer
	 */
	public function addSite($siteName, $url)
	{
		$piwik = $this->piwik->reset();

		// dd($this->piwik);
		$url = str_replace('.dev', '.com', $url);
		// dd($urlArr);
		$piwik->addSite($siteName, [$url]);

		if($piwik->hasError() > 0)
		{
			// dd('errors!');
			return false;
		}
		else
		{
			$trackingId = $piwik->getSitesIdFromSiteUrl('http://' . $url);

			// dd($trackingId);

			return (isset($trackingId)) ? $trackingId[0]->{'idsite'} : null;
		}
	}

	/**
	 * Update a site's data
	 *
	 * @param  string $siteName
	 * @param  array $urls
	 * @param  string $ecommerce
	 * @param  string $siteSearch
	 * @param  string $searchKeywordParameters
	 * @param  string $searchCategoryParameters
	 * @param  string $excludeIps
	 * @param  string $excludedQueryParameters
	 * @param  string $timezone
	 * @param  string $currency
	 * @param  string $group
	 * @param  string $startDate
	 * @return PiwikStats
	 */
	public function updateSiteData($siteName, $urls)
	{
		$piwik = $this->piwik->reset();

		$this->piwik->updateSite($siteName, $urls);

		return $this;
	}

	/*
	|--------------------------------------------------------------------------
	| Misc
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns an array of errors if there are any
	 *
	 * @return array
	 */
	public function getErrors()
	{
		return ($this->piwik->hasError() > 0) ? $this->piwik->getErrors() : false;
	}
}