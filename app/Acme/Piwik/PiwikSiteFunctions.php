<?php namespace Acme\Piwik;

use PiwikStats;
use Project;

class PiwikSiteFunctions {

	public static function updateAllSites()
	{
		$slugArray = [];

		// Loop all Piwik Sites
		$allPiwikSites = PiwikStats::getAllSites();

		foreach($allPiwikSites as $piwikSite)
		{
			// Get all website slugs & save to array
			$slug = explode('.', str_replace(['http://', 'www.'], '', $piwikSite->{'main_url'}));
			$slug = $slug[0];
			$slugArray[$slug] = $piwikSite->{'idsite'};

			// Update Piwik Site's info *BROKEN* *ERASES DATA FOR SITE*
			// $updatePiwikSite = PiwikStats::getPiwikApi($piwikSite->{'idsite'});
			// $piwikSiteDomain = str_ireplace(['http://', 'www.'], '', $piwikSite->{'main_url'});
			// $updatePiwikSite->updateSiteData($piwikSiteDomain, [$piwikSite->{'main_url'}]);
			// dd($updatePiwikSite);

			// Update Project tracking ID if Project exists
			if($project = Project::whereSlug($slug)->select('id', 'slug', 'tracking_id')->first())
			{
				$project->tracking_id = $piwikSite->{'idsite'};
				$project->save();
			}
		}

		// Search by Projects with no tracking_id
		$projects = Project::orderBy('id', 'ASC')
			->select('id', 'website_url', 'website_title', 'slug', 'tracking_id')
			->get();

		foreach($projects as $project)
		{
			// If Piwik Site exists
			if(isset($slugArray[$project->slug]))
			{
				// Update Project's tracking_id if it's found
				$project->tracking_id = $slugArray[$project->slug];
				$project->save();
			}
			// If Piwik Site DOESN'T exist
			else
			{
				$trackingId = PiwikStats::addSite($project->website_url, $project->website_url);
				// Make sure TrackingID is legit (integer above 0)
				$trackingId = (is_int($trackingId) && $trackingId !== 0) ? $trackingId : null;

				// Update Project's tracking_id
				$project->tracking_id = $trackingId;
				$project->save();
			}
		}
	}
}