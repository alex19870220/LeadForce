<?php

class AjaxController extends AdminController {

	/**
	 * Sets up viewing the Piwik site stats
	 *
	 * @param  integer $tracking_id
	 * @return integer
	 */
	public function getPiwikStats($tracking_id)
	{
		$segment = Input::get('segment', 'visits');
		$dayRange = Input::get('dayRange', 7);

		// Check for bogus dayRange
		if(! in_array($dayRange, [1, 7, 30]))
			$dayRange = 7;

		$key = "id:{$tracking_id}:s:{$segment}:d:{$dayRange}";

		return Cache::tags('piwik-stats')
			->remember($key, Config::get('acme.cache.piwikstats'), function() use ($tracking_id, $segment, $dayRange)
		{
			return $this->getPiwikApiStats($tracking_id, $segment, $dayRange);
		});
	}

	/**
	 * Get site stats from Piwik API
	 *
	 * @param  integer $tracking_id
	 * @param  string $segment
	 * @param  integer $dayRange
	 * @return integer
	 */
	public function getPiwikApiStats($tracking_id, $segment, $dayRange)
	{
		$PiwikStats = PiwikStats::getSiteStats($tracking_id);
		$PiwikStats->setDate("last{$dayRange}");

		if(! $PiwikStats)
			return Config::get('acme.display.empty.number');

		switch($segment)
		{
			case 'visits':
				$stats = PiwikStats::getVisits();
				break;
			case 'uniquevisits':
				$stats = PiwikStats::getUniqueVisitors();
				break;
			case 'conversions':
				$stats = PiwikStats::getConversions();
				break;
			default:
				return Config::get('acme.display.empty.number');
		}

		return number_format(PiwikStats::combineStats($stats));
	}

}