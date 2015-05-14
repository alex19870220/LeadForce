<?php

use Laracasts\Presenter\PresentableTrait;

class Video extends \Eloquent {

	use PresentableTrait;

	protected $fillable = [];

	protected $presenter = 'Acme\Presenters\VideoPresenter';

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'indexer_videos';

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * IndexerVideo's relationship to its Indexer campaign
	 *
	 * @return Indexer
	 */
	public function indexer()
	{
		return $this->belongsTo('Indexer', 'campaign_id');
	}

	/**
	 * IndexerVideo's relationship to its Niche
	 *
	 * @return Indexer
	 */
	public function niche()
	{
		return $this->belongsTo('Niche', 'niche_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Count the number of videos in the array and then save it
	 *
	 * @return int
	 */
	public function updateVideoCount()
	{
		// Grab the videos & count the array
		$videoCount = count($this->videos);
		$this->video_count = $videoCount;

		$this->save();

		return $video_count;
	}

	/**
	 * Grab a random video from the Video collection
	 *
	 * @return string
	 */
	public function randomVideo()
	{
		if(count($this->videos) > 0)
		{
			// Get videos & convert to array
			$videos = (array) $this->videos;

			return $videos[mt_rand(0, count($videos)-1)];
		}
		else
		{
			return null;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Videos - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getVideosAttribute($value) {
		return json_decode($value);
	}

	/**
	 * Videos - Serialize
	 *
	 * @param Array $value array of videos
	 * @return  string
	 */
	public function setVideosAttribute(Array $value) {
		$array = array_unique($value);
		$array_count = count($array);
		$jsonVideos = json_encode($array);
		if($jsonVideos) {
			$this->attributes['videos'] = $jsonVideos;
			$this->attributes['video_count'] = $array_count;
		} else {
			throw new InvalidArgumentException("Unable to convert the videos array to JSON");
		}
	}

	/**
	 * Keywords - Serialize
	 *
	 * @param Array $value array of options
	 */
	public function setKeywordsAttribute(Array $value) {
		$value = array_unique($value);
		$jsonKeywords = json_encode($value);
		if($jsonKeywords) {
			$this->attributes['keywords'] = $jsonKeywords;
		} else {
			throw new InvalidArgumentException("Unable to convert options object to JSON");
		}
	}

	/**
	 * Keywords - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getKeywordsAttribute($value) {
		return json_decode($value);
	}

}