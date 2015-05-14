<?php

class ViewProjectController extends BaseController {

	/**
	 * @var string $templatePath
	 */
	protected $templatePath;

	/**
	 * @var Project $project
	 */
	protected $project;

	/**
	 * @var State $state
	 */
	protected $state;

	/**
	 * @var City $city
	 */
	protected $city;

	/**
	 * @var Niche $niche
	 */
	protected $niche;

	/**
	 * Initializer.
	 *
	 * @return $recentposts An array of the recent posts for the sidebar
	 */
	public function __construct()
	{
		parent::__construct();

		// Route Parameters
		$this->project	= Route::input('projectSlug');
		$this->state	= Route::input('st');
		$this->city		= Route::input('city');
		$this->niche	= Route::input('nicheSlug');

		// Set the Niche
		if(is_null($this->niche))
			$this->niche = $this->project->niche;

		// Share the models
		if(isset($this->project))
			View::share('project', $this->project);
		if(isset($this->state))
			View::share('state', $this->state);
		if(isset($this->city))
			View::share('city', $this->city);
		if(isset($this->niche))
			View::share('niche', $this->niche);

		// Template Path & Share
		$this->templatePath = $this->project->present()->templatePath;
		View::share('templatePath', $this->templatePath);

		// Grab Adsense
		if($this->project->getOption('monetization.adsense.enabled') === true && ! empty($this->project->getOption('monetization.adsense.adsense_id')))
			$adsense = AdsenseHelper::getAdData($this->project->getOption('monetization.adsense.adsense_id'));
	}

	/**
	 * Project Home
	 *
	 * @return Response
	 */
	public function getProjectHome()
	{
		$view = View::make('frontend.pages.home', compact('project'))->render();

		return Shortcodes::process($view);
	}

	/*
	|--------------------------------------------------------------------------
	| Geo Locations
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * View All States
	 *
	 * @return State $states
	 */
	public function getDirectory()
	{
		$states = State::remember(Config::get('acme.cache.geo'))->orderBy('state', 'ASC')->get();

		return View::make($this->templatePath.'.geolocations.states', compact('states'));
	}

	/**
	 * View State
	 *
	 * @return City $cities
	 */
	public function getViewState($project, $tld, $state)
	{
		// Cities by Letter
		$cityLetters = City::remember(Config::get('acme.cache.geo'))
			->select('id', 'state_id', 'letter')
			->where('state_id', '=', $state->id)
			->groupBy('letter')
			->orderBy('letter')
			->get();

		// Grab Cities
		$cities = City::remember(Config::get('acme.cache.geo'))
			->where('state_id', '=', $state->id)
			->where('population', '>', 0)
			->orderBy('city')
			->limit(150)
			->get();

		// Current page video key
		$videoKey = $state->cacheKey($this->project->id, 'video');
		$video = Cache::get($videoKey, '');
		View::share('video', $video);

		return View::make($this->templatePath.'.geolocations.state', compact('cityLetters', 'cities'));
	}

	/**
	 * View State/Letter
	 *
	 * @return City $cities
	 */
	public function getViewStateCityLetter($project, $tld, $state, $cityLetter)
	{
		// Cities by Letter
		$cityLetters = City::remember(Config::get('acme.cache.geo'))
			->select('id', 'state_id', 'letter')
			->where('state_id', '=', $state->id)
			->groupBy('letter')
			->orderBy('letter')
			->get();

		// Grab Cities
		$cities = City::remember(Config::get('acme.cache.geo'))
			->where('state_id', '=', $state->id)
			->where('letter', '=', $cityLetter)
			->orderBy('city')
			->get();

		// Current page video key
		$videoKey = $state->cacheKey($this->project->id, 'video');
		$video = Cache::get($videoKey, '');
		View::share('video', $video);

		return View::make($this->templatePath.'.geolocations.state-letter', compact('cityLetters', 'cities'));
	}

	/**
	 * View City
	 *
	 * @return Niche $niches
	 */
	public function getViewCity()
	{
		// Current page video key
		$videoKey = $this->city->cacheKey($this->project->id, $this->state->id, 'video');
		$video = Cache::get($videoKey, '');
		View::share('video', $video);

		return View::make($this->templatePath.'.geolocations.city');
	}

	/**
	 * View Niche
	 *
	 * @return Niche $niche
	 */
	public function getViewNiche()
	{
		// Current page video key
		$videoKey = $this->niche->cacheKey($this->project->id, $this->state->id, $this->city->id, 'video');
		$video = Cache::get($videoKey, '');
		View::share('video', $video);

		return View::make($this->templatePath.'.pages.niche');
	}

	/*
	|--------------------------------------------------------------------------
	| Misc Pages
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * View Admin-Created Pages
	 * @return Response
	 */
	public function getPage()
	{
		// Grab the page
		$page = Route::input('pageSlug');

		return View::make('frontend.pages.page', compact('page'));
	}

	/**
	 * About Us
	 *
	 * @return Response
	 */
	public function getAboutUs()
	{
		return View::make('frontend.pages.aboutus');
	}

	/**
	 * Terms of Service
	 *
	 * @return Response
	 */
	public function getTOS()
	{
		return View::make('frontend.pages.legal.tos');
	}

	/**
	 * Privacy Policy
	 *
	 * @return Response
	 */
	public function getPrivacy()
	{
		return View::make('frontend.pages.legal.privacy');
	}

	/**
	 * Disclaimer
	 *
	 * @return Response
	 */
	public function getDisclaimer()
	{
		return View::make('frontend.pages.legal.disclaimer');
	}

	/**
	 * Earnings Disclaimer
	 *
	 * @return Response
	 */
	public function getEarningsDisclaimer()
	{
		return View::make('frontend.pages.legal.earningsdisclaimer');
	}

	/**
	 * Contact Us
	 *
	 * @return Response
	 */
	public function getContactUs()
	{
		return View::make('frontend.pages.contactus');
	}

	/**
	 * Returns a blank page
	 *
	 * @return Response
	 */
	public function getBlankPage()
	{
		return View::make('frontend.blank');
	}

}
