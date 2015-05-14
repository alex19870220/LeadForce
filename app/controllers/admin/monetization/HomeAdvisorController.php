<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\HomeAdvisorForm;
use Acme\Monetization\HomeAdvisor\HomeAdvisorParser;

class HomeAdvisorController extends AdminController {

	/**
	 * The types of HomeAdvisor URL's there are
	 *
	 * @var array $urlTypes
	 */
	protected $urlTypes = [
			'iframe'		=> 'iFrame URLs',
			'redirect'		=> 'Redirect URLs',
		];

	/**
	 * @var HomeAdvisorForm $homeAdvisorForm
	 */
	protected $homeAdvisorForm;

	/**
	 * @var HomeAdvisorParser $homeAdvisorParser
	 */
	protected $homeAdvisorParser;

	/**
	 * Instantiate the object
	 *
	 * @param HomeAdvisorForm $homeAdvisorForm
	 */
	public function __construct(HomeAdvisorForm $homeAdvisorForm, HomeAdvisorParser $homeAdvisorParser)
	{
		$this->homeAdvisorForm = $homeAdvisorForm;
		$this->homeAdvisorParser = $homeAdvisorParser;

		parent::__construct();
	}

	/**
	 * Show the HomeAdvisor index
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$urlTypes = $this->urlTypes;

		// Get HomeAdvisor URLs
		$homeAdvisorUrls = DB::table('homeadvisor_urls')
				->where('user_id', '=', Sentry::getUser()->id)
				->get();

		// dd();

		return View::make('backend.monetization.homeadvisor', compact('urlTypes', 'homeAdvisorUrls'));
	}

	/*
	|--------------------------------------------------------------------------
	| Add URL's
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Adds HomeAdvisor URL's to the current user's list
	 *
	 * @return Response
	 */
	public function postAddUrls()
	{
		try
		{
			$this->homeAdvisorForm->validate(Input::all());

			// Do the spreadsheet processing
			$spreadsheetData = $this->homeAdvisorParser->processSpreadsheet(Input::file('spreadsheet')->getRealPath());

			$homeAdvisorUrls = DB::table('homeadvisor_urls')
				->where('user_id', '=', Sentry::getUser()->id)
				->where('url_type', '=', Input::get('url_type'));

			// Insert into DB if doesn't exist
			if($homeAdvisorUrls->count() == 0)
			{
				DB::table('homeadvisor_urls')
					->insert([
						'user_id'	=> Sentry::getUser()->id,
						'url_type'	=> Input::get('url_type'),
						'urls'		=> $spreadsheetData,
					]);
			}
			else
			{
				$homeAdvisorUrls->update([
						'urls'		=> $spreadsheetData,
					]);
			}

			Flash::success('HomeAdvisor URL\'s have been updated/added!');

			return Redirect::route('homeadvisor');
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}
}