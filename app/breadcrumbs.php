<?php
// namespace Routes\Breadcrumbs;

// use Breadcrumbs;
// use Route;

if(Route::current())
{
	/*
	|--------------------------------------------------------------------------
	| Route Parameters
	|--------------------------------------------------------------------------
	*/

	$project	= Route::input('projectSlug');
	$state		= Route::input('st');
	$city		= Route::input('city');
	$cityLetter = Route::input('cityLetter');
	$niche		= Route::input('nicheSlug');
	$page		= Route::input('pageSlug');

	/*
	|--------------------------------------------------------------------------
	| Geolocation Pages
	|--------------------------------------------------------------------------
	*/

	# Home
	Breadcrumbs::register('project/home', function($breadcrumbs) use ($project)
	{
		$breadcrumbs->push('Home', $project->present()->homeUrl);
	});

	# State Directory
	Breadcrumbs::register('browse/states', function($breadcrumbs) use ($project)
	{
		$breadcrumbs->parent('project/home');
		$breadcrumbs->push('Directory', $project->present()->directoryUrl);
	});

	# State
	Breadcrumbs::register('project/state', function($breadcrumbs) use ($state)
	{
		$breadcrumbs->parent('browse/states');
		$breadcrumbs->push($state->state, $state->present()->url);
		// $breadcrumbs->push($state->present()->pageTitle, $state->present()->url);
	});

	# State/City Letter
	Breadcrumbs::register('project/state/letter', function($breadcrumbs) use ($state, $cityLetter)
	{
		$breadcrumbs->parent('project/state');
		$breadcrumbs->push("\"{$cityLetter}\" Cities", $state->present()->urlCityLetter($cityLetter));
		// $breadcrumbs->push($state->present()->pageTitle, $state->present()->url);
	});

	# City
	Breadcrumbs::register('project/city', function($breadcrumbs) use ($project, $city)
	{
		$breadcrumbs->parent('project/state');
		// $breadcrumbs->push($city->city, $city->present()->url);
		$breadcrumbs->push($project->niche->present()->pageTitle, $city->present()->url);
	});

	# Niche
	Breadcrumbs::register('project/niche', function($breadcrumbs) use ($city, $niche)
	{
		$breadcrumbs->parent('project/state');
		$breadcrumbs->push($city->city, $city->present()->url);
		$breadcrumbs->push($niche->present()->pageTitle, $niche->present()->url);
	});

	/*
	|--------------------------------------------------------------------------
	| Regular Pages
	|--------------------------------------------------------------------------
	*/

	Breadcrumbs::register('project/page', function($breadcrumbs) use ($page)
	{
		$breadcrumbs->parent('project/home');
		$breadcrumbs->push($page->present()->title, $page->url);
	});

	Breadcrumbs::register('project/about-us', function($breadcrumbs) use ($project)
	{
		$breadcrumbs->parent('project/home');
		$breadcrumbs->push('About Us', $project->present()->aboutUsUrl);
	});

	Breadcrumbs::register('project/contact-us', function($breadcrumbs) use ($project)
	{
		$breadcrumbs->parent('project/home');
		$breadcrumbs->push('Contact Us', $project->present()->contactPageUrl);
	});

	/*
	|--------------------------------------------------------------------------
	| Legal Pages
	|--------------------------------------------------------------------------
	*/

	Breadcrumbs::register('project/privacy', function($breadcrumbs) use ($project)
	{
		$breadcrumbs->parent('project/home');
		$breadcrumbs->push('Privacy Policy', route('project/privacy', [$project->slug, $project->tld]));
	});

	Breadcrumbs::register('project/tos', function($breadcrumbs) use ($project)
	{
		$breadcrumbs->parent('project/home');
		$breadcrumbs->push('Terms of Service', route('project/tos', [$project->slug, $project->tld]));
	});

	Breadcrumbs::register('project/disclaimer', function($breadcrumbs) use ($project)
	{
		$breadcrumbs->parent('project/home');
		$breadcrumbs->push('Disclaimer', route('project/disclaimer', [$project->slug, $project->tld]));
	});

	Breadcrumbs::register('project/earnings-disclaimer', function($breadcrumbs) use ($project)
	{
		$breadcrumbs->parent('project/home');
		$breadcrumbs->push('Earnings Disclaimer', route('project/earnings-disclaimer', [$project->slug, $project->tld]));
	});

}