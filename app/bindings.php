<?php

/*
|--------------------------------------------------------------------------
| Bind - Project
|--------------------------------------------------------------------------
|
|
|
*/

Route::bind('projectSlug', function($value, $route)
{
	$project = Project::cacheTags('projects')
		->remember(Config::get('acme.cache.project'))
		->with([
			'niche',
			'niche.children',
			'sidebar',
			'sidebar.widgets' => function($q) {
				$q->orderBy('widget_order', 'ASC');
			},
			'pages' => function($q) {
				$q->select('id', 'project_id', 'title', 'slug', 'menu_label', 'icon', 'location', 'page_order', 'active');
			}])
		->where('slug', '=', $value)
		->first();

		if(! $project)
			App::abort(404);

		return $project;
});

/*
|--------------------------------------------------------------------------
| Bind - Project TLD
|--------------------------------------------------------------------------
|
|
|
*/

Route::bind('tld', function($value, $route)
{
	// dd($route);
	$project = $route->getParameter('projectSlug');

	if($project->tld !== $value)
		App::abort(404);

	return $value;
});

/*
|--------------------------------------------------------------------------
| Bind - State Abbr
|--------------------------------------------------------------------------
|
|
|
*/

Route::bind('st', function($value, $route)
{
	$state = State::remember(Config::get('acme.cache.geo'))
		->whereAbbr($value)
		->first();

	if(! $state)
		App::abort(404);

	return $state;
});


/*
|--------------------------------------------------------------------------
| Bind - State Slug
|--------------------------------------------------------------------------
|
|
|
*/

Route::bind('stateSlug', function($value, $route)
{
	$state = State::remember(Config::get('acme.cache.geo'))
		->whereSlug($value)
		->first();

	if(! $state)
		App::abort(404);

	return $state;
});

/*
|--------------------------------------------------------------------------
| Bind - City
|--------------------------------------------------------------------------
|
|
|
*/

Route::bind('city', function($value, $route)
{
	$state = $route->getParameter('st');

	// The problem with Routes permalinks......
	// dd($value);

	$city = City::remember(Config::get('acme.cache.geo'))
		->with('county')
		->where('state_id', '=', $state->id)
		->where('slug', '=', $value)
		->first();

	if(! $city)
		App::abort(404);

	return $city;
});


/*
|--------------------------------------------------------------------------
| Bind - Niche
|--------------------------------------------------------------------------
|
|
|
*/

Route::bind('nicheSlug', function($value, $route)
{
	$project = $route->getParameter('projectSlug');

	$niche = Niche::cacheTags('projects')
		->remember(Config::get('acme.cache.niche'))
		->where('parent_id', '=', $project->niche_id)
		->where('slug', '=', $value)
		->first();

	if(! $niche)
		App::abort(404);

	return $niche;
});


/*
|--------------------------------------------------------------------------
| Bind - Page
|--------------------------------------------------------------------------
|
|
|
*/

Route::bind('pageSlug', function($value, $route)
{
	$project = $route->getParameter('projectSlug');

	$page = Page::remember(Config::get('acme.cache.page'))->where(function($query) use ($project, $value)
			{
				$query->where('project_id', '=', $project->id);
				$query->where('slug', '=', $value);
			})->first();

	if(! $page)
		App::abort(404);

	return $page;
});

/*
|--------------------------------------------------------------------------
| Route Patterns
|--------------------------------------------------------------------------
|
|
*/

Route::pattern('projectSlug', '[a-z0-9-]+');
// Route::pattern('tld', '[a-z.]+');
Route::pattern('st', '[a-z]{2}');
Route::pattern('stateSlug', '[a-z0-9-]+');
Route::pattern('city', '[a-z0-9-]+');
Route::pattern('cityLetter', '[A-Z]');
Route::pattern('nicheSlug', '[a-z0-9-]+');
Route::pattern('pageSlug', '[a-z0-9-]+');
// Generic patterns
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');
Route::pattern('username', '[a-zA-Z0-9]+');