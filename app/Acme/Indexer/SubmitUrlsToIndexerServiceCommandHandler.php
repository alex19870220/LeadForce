<?php namespace Acme\Indexer;

use Acme\Indexer\Services\IndexerServices;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Acme\Indexer\Helpers\PageLister;

class SubmitUrlsToIndexerServiceCommandHandler {

	use DispatchableTrait;

	/**
	 * Handle the command
	 *
	 * @param  Commander $command
	 * @return boolean
	 */
	public function handle($command)
	{
		$pageLister = new PageLister($command->projectId);
		$urlList = $pageLister->grabStates();
		$urlList = str_replace('.dev', '.com', $urlList);

		// dd($command);

		$indexerService = IndexerServices::InstantLinkIndexer($urlList, $command->apiKey);

		return true;
	}
}