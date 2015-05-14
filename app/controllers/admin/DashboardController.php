<?php

class DashboardController extends AdminController {

	/**
	 * Show the domain homepage
	 *
	 * @return Response
	 */
	public function getHome()
	{
		// If logged in...
		if(Sentry::check())
			return Redirect::route('dashboard');

		// Show the page
		return View::make('auth.home');
	}

	/**
	 * Show the administration dashboard page.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// Show the page
		return View::make('backend.dashboard');
	}

	/*
	|--------------------------------------------------------------------------
	| Modals
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Displays all content shortcodes & usge info
	 *
	 * @return Response
	 */
	public function getModalShortcodes()
	{
		return View::make('backend.modals.shortcodes');
	}

}