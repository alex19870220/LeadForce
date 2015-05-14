<?php

class HomeController extends BaseController {

	/**
	 * Returns user to the correct home page
	 *
	 * @return Redirect
	 */
	protected function goToHome()
	{
		$route = Route::current();
		// dd($route);
		$project = $route->getParameter('project');
		dd($project);
		if($project !== '') return Redirect::route('project/home', $project->slug);
		// Else redirect to admin dash
		return Redirect::route('dashboard');
	}

}