<?php namespace Acme\Indexer\Events;

use Indexer;
use Video;

class NotEnoughVideos {

	public $indexer_id;

	function __construct(int $indexer_id)
	{
		$this->indexer_id = $indexer_id;
		// dd('There's no fucking videos!);
	}
}