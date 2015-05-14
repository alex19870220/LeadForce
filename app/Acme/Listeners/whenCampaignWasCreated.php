<?php namespace Acme\Listeners;

use Laracasts\Commander\Events\EventListener;
use Acme\Indexer\Events\CampaignWasCreated;

class EmailNotifier extends EventListener {

	public function whenCampaignWasCreated(CampaignWasCreated $event)
	{
		var_dump('send an email');
	}

}