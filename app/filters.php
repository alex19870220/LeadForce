<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	/**
	 * Redirect www URL's to non-WWW
	 */
	if (substr($request->header('host'), 0, 4) === 'www.')
	{
		$domain = parse_url(Request::url(), PHP_URL_HOST);
		$domain = str_replace('www.', '', $domain);
		$request->headers->set('host', $domain);
		return Redirect::to($request->path(), 301);
	}
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| CSRF on all POST/PUT/DELETE routes
|--------------------------------------------------------------------------
|
|
*/

Route::when('*', 'csrf', ['post', 'put', 'delete']);

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	// Check if the user is logged in
	if (!Sentry::check())
	{
		// Store the current uri in the session
		Session::put('loginRedirect', Request::url());

		// Redirect to the login page
		return Redirect::route('login');
	}
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Sentry::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Admin authentication filter.
|--------------------------------------------------------------------------
|
| This filter does the same as the 'auth' filter but it checks if the user
| has 'admin' privileges.
|
*/

Route::filter('admin-auth', function()
{
	// Check if the user is logged in
	if ( ! Sentry::check())
	{
		// Store the current uri in the session
		Session::put('loginRedirect', Request::url());

		// Redirect to the login page
		return Redirect::route('login');
	}

	// Check if the user has access to the admin page
	if ( ! Sentry::getUser()->hasAccess('admin'))
	{
		// Show the insufficient permissions page
		return App::abort(403);
	}
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::getToken() != Input::get('_token') &&  Session::getToken() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Sentry Route Filters http://laravelsnippets.com/snippets/sentry-route-filters
|--------------------------------------------------------------------------
|
|
*/

/**
* hasAcces filter (permissions)
*
* Check if the user has permission (group/user)
*/
Route::filter('hasAccess', function($route, $request, $value)
{
	try
	{
		$user = Sentry::getUser();

		if(!$user->hasAccess($value))
		{
			Flash::error(Lang::get('user.noaccess'));

			return Redirect::route('login');
		}
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		Flash::error(Lang::get('user.notfound'));

		return Redirect::route('login');
	}
});

/**
* InGroup filter
*
* Check if the user belongs to a group
*/
Route::filter('inGroup', function($route, $request, $value)
{
	// Check if the user is logged in
	if (!Sentry::check())
	{
		// Redirect to the login page
		return Redirect::route('login');
	} else {
		try
		{
			$user = Sentry::getUser();
			$group = Sentry::findGroupByName($value);

			if(! $user->inGroup($group))
			{
				Flash::error(Lang::get('user.noaccess'));

				return Redirect::route('login');
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			Flash::error(Lang::get('user.notfound'));

			return Redirect::route('login');
		}
			catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			Flash::error(Lang::get('group.notfound'));

			return Redirect::route('login');
		}
	}
});

/*
|--------------------------------------------------------------------------
| Caching Filters
|--------------------------------------------------------------------------
|
| Cache-Full		- Completely caches the output HTML
| Cache-Browser		- Leverages browser caching
|
*/

/*
 * Cache Full
 */
Route::filter('cache-full', function($route, $request, $response = null)
{
	if(App::Environment() != 'local')
	{
		$key = 'route-'.Str::slug(Request::url());
		if(is_null($response) && Cache::has($key))
		{
			return Cache::get($key);
		}
			elseif(!is_null($response) && !Cache::has($key))
		{
			Cache::put($key, $response->getContent(), 30);
		}
	}
});

/*
 * Cache Browser
 */
Route::filter('cache-browser', function($route, $request, $response)
{
	App::after(function($request, $response)
	{
		$response->headers->set('P3P','CP="NOI ADM DEV PSAi COM NAV OUR OTR STP IND DEM"');
		$response->headers->set('Cache-Control', 'max-age=2546, public, must-revalidate, proxy-revalidate');	// Browser caching!
		$response->headers->set('Pragma', 'public');															// HTTP 1.0
		$response->headers->set('Expires', date(DATE_RFC822,strtotime("1 week")));								// Date in the past


	});
});

/*
|--------------------------------------------------------------------------
| Language
|--------------------------------------------------------------------------
|
| Detect the browser language.
|
*/

// Route::filter('detectLang',  function($route, $request, $lang = 'auto')
// {

// 	if($lang != "auto" && in_array($lang , Config::get('app.available_language')))
// 	{
// 		Config::set('app.locale', $lang);
// 	}else{
// 		$browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
// 		$browser_lang = substr($browser_lang, 0,2);
// 		$userLang = (in_array($browser_lang, Config::get('app.available_language'))) ? $browser_lang : Config::get('app.locale');
// 		Config::set('app.locale', $userLang);
// 		App::setLocale($userLang);
// 	}
// });