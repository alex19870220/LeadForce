<?php

class SearchController extends ViewProjectController {

	/**
	 * Returns the Search page
	 *
	 * @return Response
	 */
	public function getSearchLocation()
	{
		return View::make('frontend.search.search');
	}

	/**
	 * Search for a Niche + Zip code
	 *
	 * @return Response
	 */
	public function postSearchLocation()
	{
		// Grab search POST data and search for a city
		$input = Input::all();
		$zip   = Input::get('query');
		$city  = City::where('postal_codes', 'LIKE', "%{$zip}%")->first()->get();

		return View::make('frontend.search.results');
	}
}