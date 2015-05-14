<?php

use Acme\Indexer\Events\CampaignWasCreated;
use Acme\Indexer\Events\CampaignWasStarted;
use Acme\Indexer\Events\CampaignWasStopped;
use \Flash;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;
use \Project;
use \Redirect;
use \Video;

class Indexer extends \Eloquent {

	use EventGenerator, PresentableTrait;

	protected $fillable = ['project_id'];

	protected $presenter = 'Acme\Presenters\IndexerPresenter';

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'indexer_campaigns';

	/**
	 * Indexer's relationship to Niche
	 *
	 * @return relationship
	 */
	public function project()
	{
		return $this->belongsTo('Project', 'project_id');
	}

	/**
	 * Indexer's relationship to Niche
	 *
	 * @return relationship
	 */
	public function niche()
	{
		return $this->belongsTo('Niche', 'niche_id');
	}

	/**
	 * Indexer's relationship to IndexerVideo
	 *
	 * @return relationship
	 */
	public function videos()
	{
		return $this->hasMany('Video', 'campaign_id');
	}

	/**
	 * Returns the keyword count for the Indexer
	 *
	 * @return integer
	 */
	public function keywordCount()
	{
		return $this->videos->sum('keyword_count');
	}

	/**
	 * Returns the video count for the Indexer
	 *
	 * @return integer
	 */
	public function videoCount()
	{
		return $this->videos->sum('video_count');
	}

	/**
	 * Create a new Indexer Campaign
	 *
	 * @param  integer $project_id
	 * @return Indexer
	 */
	public static function post($project_id)
	{
		$project = Project::findOrFail($project_id)->first();

		// Check if Project already has an Indexer campaign or not
		if(Indexer::where('project_id', '=', $project_id)->count() > 0)
		{
			Flash::danger('That project already has an Indexer campaign running!');

			return Redirect::route('indexer');
		}

		$campaign = new static(compact('project_id'));

		$campaign->niche_id = $project->niche_id;

		$campaign->save();

		$campaign_id = $campaign->id;

		// Fire off the CampaignWasCreated event
		$campaign->raise(new CampaignWasCreated($campaign));

		return $campaign;
	}

	/**
	 * Update the active status of a Indexer
	 *
	 * @param  int $campaign_id
	 * @return Indexer
	 */
	public static function updateStatus($campaign_id)
	{
		$campaign = static::findOrFail($campaign_id);

		// Set to active or inactive
		if($campaign->active == false)
		{
			// Start indexing
			$campaign->active = true;

			$campaign->raise(new CampaignWasStarted($campaign));
		}
		else
		{
			// Stop indexing
			$campaign->active = false;
			$campaign->complete = true;

			$campaign->raise(new CampaignWasStopped($campaign));
		}

		$campaign->save();

		return $campaign;
	}

	/*
	|--------------------------------------------------------------------------
	| Active States
	|--------------------------------------------------------------------------
	|
	|
	|
	*/



	/*
	|--------------------------------------------------------------------------
	| Query Scopes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Query Scope for active Indexers
	 *
	 * @param  Eloquent $query
	 * @return $query
	 */
	public function scopeActive($query)
	{
		return $query->whereActive(true);
	}

	/**
	 * Query Scope for finished Indexers
	 *
	 * @param  Eloquent $query
	 * @return $query
	 */
	public function scopeFinished($query)
	{
		return $query->whereComplete(true);
	}

	/**
	 * Query Scope for active Indexers
	 *
	 * @param  Eloquent $query
	 * @return $query
	 */
	public function scopeInactive($query)
	{
		return $query->whereActive(false);
	}

	/**
	 * Query Scope for finished Indexers
	 *
	 * @param  Eloquent $query
	 * @return $query
	 */
	public function scopeProcessing($query)
	{
		return $query->whereComplete(false);
	}

}