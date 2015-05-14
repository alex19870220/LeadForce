<?php

class AccountController extends AdminController {

	/*
	|--------------------------------------------------------------------------
	| Dashboard
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * User dashboard page.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// Show the page
		return View::make('backend.account.dashboard');
	}

	/*
	|--------------------------------------------------------------------------
	| Settings
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * User dashboard page.
	 *
	 * @return Response
	 */
	public function getSettings()
	{
		// Show the page
		return View::make('backend.account.settings');
	}

	public function postUpdateIndexerAPIs()
	{
		// Get Indexer API's
		$indexerAPIs = Config::get('acme.api.indexers');

		if(empty($indexerAPIs) || ! is_array($indexerAPIs) || count($indexerAPIs) < 1)
		{
			Flash::error('There are no Indexer APIs set up in the app config!');

			return Redirect::back();
		}

		// Get User
		$user = Sentry::getUser();

		// Loop each Indexer API & set the desired API keys
		foreach($indexerAPIs as $indexerAPI => $indexerAPIData)
		{
			if(is_null(Config::get('acme.api.indexers.' . $indexerAPI)))
				continue;

			// Update User options
			$user->setOption('indexers.' . $indexerAPI . '.apikey', e(Input::get($indexerAPI)));
		}

		// Save the User
		if($user->save())
		{
			Flash::success('Indexer API keys have been updated!');
			return Redirect::route('account/settings');
		}

		// Return error if failed
		Flash::error('There was an error saving your Indexer API keys.');
		return Redirect::back()->withInput();
	}
}