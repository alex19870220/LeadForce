<?php

use Acme\Forms\AdsenseForm;
use Acme\Forms\FormValidationException;

class AdsenseController extends AdminController {

	/**
	 * @var AdsenseForm $adsenseForm
	 */
	protected $adsenseForm;

	/**
	 * Instantiate the object
	 *
	 * @param AdsenseForm $adsenseForm
	 */
	function __construct(AdsenseForm $adsenseForm)
	{
		$this->adsenseForm = $adsenseForm;

		parent::__construct();
	}

	/**
	 * User dashboard page.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$userId = Sentry::getUser()->id;
		$adsenseForm = Adsense::whereUserId($userId)->first();

		// If User doesn't have Adsense table
		if(! $adsenseForm)
			$adsenseForm = new Adsense;

		$allAdsenseGroups = Adsense::whereUserId($userId)->orderBy('id', 'DESC')->get();

		// Show the page
		return View::make('backend.monetization.adsense', compact('adsenseForm', 'allAdsenseGroups'));
	}

	/**
	 * Creates or updates the current user's Adsense codes
	 *
	 * @return Response
	 */
	public function postCreateAdsense()
	{
		try
		{
			$this->adsenseForm->validate(Input::all());


			// Check if user has Adsense already set up
			$userId = Sentry::getUser()->id;
			$userAdsense = Adsense::whereUserId($userId)->first();

			// If User doesn't have Adsense table
			if(! $userAdsense)
			{
				$userAdsense = new Adsense;
				$userAdsense->user_id = Sentry::getUser()->id;
			}

			// Set the data
			$userAdsense->label			= e(Input::get('label'));
			$userAdsense->publisher_id	= Input::get('publisher_id');
			$userAdsense->ads			= $this->setAdsArray();

			// Was the project created?
			if($userAdsense->save())
			{
				// Redirect to the new project page
				Flash::success('Your Adsense ad codes have been updated.');

				return Redirect::route('adsense');
			}

			// Redirect to the project create page
			Flash::danger('Something went wrong.');

			return Redirect::route('adsense');
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Setting Data
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Sets the array of Ad Types/IDs while making sure each one is real
	 *
	 * @param   array $ads
	 * @return  array $returnArray
	 */
	protected function setAdsArray()
	{
		$returnArray = [];

		foreach(AdsenseHelper::getAdTypes() as $allAdType => $allAdTypeData)
		{
			if(! empty(Input::get($allAdType)))
				$returnArray[$allAdType] = Input::get($allAdType);
		}

		return $returnArray;
	}

}