<?php namespace Acme\Sitemaps\Events;

class SitemapWasRebuilt {

	public $project_id;

	function __construct($project_id) /* or pass in just the relevant fields */
	{
		$this->project_id = $project_id;

		// Works......
		// dd('Sitemap ' . $project_id . ' was rebuilt!!');
	}
}