<?php namespace Acme\Indexer\Helpers;

use Acme\Indexer\Events\ScrapingVideosWasStarted;
use Acme\Scraper\VideoScraper\VideoScraper;
use Flash;
use Indexer;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\EventGenerator;
use Niche;
use Project;
use Redirect;
use Video;

class YoutubeVideoScraper {

	use EventGenerator;

	protected $indexerCampaign;

	protected $projectNiche;

	protected $projectNiches;

	protected $projectNicheChildren;

	protected $totalScraped = 0;

	function __construct($campaign_id)
	{
		// Grab the Indexer Campaign for these videos & eager load it all
		$indexerCampaign = Indexer::with([
			'project' => function($q) {
					$q->addSelect(['id', 'niche_id']);
				},
			'project.niche' => function($q) {
					$q->addSelect(['id', 'keyword_main', 'keywords']);
				},
			])->findOrFail($campaign_id);

		$this->indexerCampaign = $indexerCampaign;
		$project = $indexerCampaign->project;

		// Get the project and all niches into a beautiful array of majestic epicness
		$projectNiche = $project->niche->toArray();
		$projectNiches = $project->niche->children()->select('id', 'keyword_main', 'keywords')->get()->toArray();
		$projectNiches[] = $projectNiche;

		$this->projectNiches = $projectNiches;
	}

	/**
	 * Static function to do the dirty work
	 *
	 * @param  int    $campaign_id
	 * @return array  $videoIds
	 */
	public static function scrapeVideos($campaign_id)
	{
		// Give us some time & energy
		ini_set('memory_limit','512M');

		$obj = new static($campaign_id);

		$projectNiches = $obj->projectNiches;

		// Loop through the niches and scrape for each one
		$obj->processNicheScraping($projectNiches);

		$obj->indexerCampaign->raise(new ScrapingVideosWasStarted($campaign_id));

		return $obj;
	}

	/**
	 * Loop through each Niche passed in and scrape videos for them
	 *
	 * @param  Array  $niches
	 * @return true
	 */
	public function processNicheScraping(Array $niches)
	{
		// Count the total videos
		$i = 0;

		// Loop through each project's niche and get them ready for video scraping
		foreach($niches as $niche)
		{
			// Niche ID
			$nicheId = $niche['id'];
			$keywords = $niche['keywords'];
			$keywords[]  = $niche['keyword_main'];
			// Trim & lowercase the array
			$keywords = array_map('trim', $keywords);
			$keywords = array_map('strtolower', $keywords);
			$keywords = array_unique($keywords);

			// Scrape the Video ID's
			$videoIds = VideoScraper::scrapeVideos($keywords);

			// Find or create an Video model for these videos
			$nicheVideos = Video::where('campaign_id', '=', $this->indexerCampaign->id)
				->where('niche_id', '=', $nicheId)
				->first();

			// Insert a new Video row
			if(is_null($nicheVideos))
			{
				$nicheVideos = new Video;
				$nicheVideos->campaign_id	= $this->indexerCampaign->id;
				$nicheVideos->niche_id		= $nicheId;
				$nicheVideos->videos		= array_values(array_unique($videoIds));
				$nicheVideos->keywords		= $keywords;
				$nicheVideos->keyword_count	= count($keywords);
				$nicheVideos->save();
			}
			else // Update existing Video
			{
				// Get the original Videos' videoIds
				$oldVideoIds = $nicheVideos->videos;

				$mergedVideoIds = array_values(array_unique(array_merge((array) $oldVideoIds, $videoIds)));

				$nicheVideos->videos			= $mergedVideoIds;
				$nicheVideos->video_count		= count($mergedVideoIds);
				$nicheVideos->keywords			= $keywords;
				$nicheVideos->keyword_count		= count($keywords);
				$nicheVideos->save();
			}

			$i = $i + count($videoIds);

		}

		// Update total videos count for object
		$this->totalScraped = $i;

		return $i;
	}
}