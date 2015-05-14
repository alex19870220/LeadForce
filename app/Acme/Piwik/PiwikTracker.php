<?php namespace Acme\Piwik;

use App;
use Cache;
use Config;
use Exception;
use InvalidArgumentException;
use PiwikHelper;
use Request;
use Response;
use Route;
use URL;

class PiwikTracker {

	/**
	 * @var Project
	 */
	protected $project;

	/**
	 * Tells if the Piwik server will be hidden or not
	 *
	 * @var boolean
	 */
	private $hidden = true;

	/**
	 * @var integer
	 */
	private $tracking_id;

	/**
	 * @var integer
	 */
	private $token;

	/**
	 * @var piwik.shuttertools.com
	 */
	private $trackerUrl;

	/**
	 * @var integer
	 */
	private $cacheLifetime = 1440;

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		// Route Parameters
		$this->project		= Route::input('projectSlug');
		$this->tracking_id	= $this->project->tracking_id;
		$this->token		= Config::get('acme.api.piwik.token');
		$this->trackerUrl	= Config::get('acme.api.piwik.url');
		$this->cacheLifetime= Config::get('acme.cache.piwik');

		// Normalize the tracker url
		$this->trackerUrl = str_replace(['http://', 'https://'], '', $this->trackerUrl);
		$this->trackerUrl = rtrim($this->trackerUrl, '/');

		// Make sure all the vars are good
		if ( ! is_numeric($this->tracking_id) || empty($this->tracking_id))
		{
			throw new InvalidArgumentException("PiwikTracker configuration option 'site_id' must be a non-zero integer");
		}

		if (empty($this->trackerUrl))
		{
			throw new InvalidArgumentException("PiwikTracker configuration option 'tracker_url' must be a valid url");
		}

		if (empty($this->token) || strlen($this->token) != 32)
		{
			throw new InvalidArgumentException("PiwikTracker configuration option 'token' must be a valid piwik authorization token when running in hidden mode");
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Piwik Javascript Tracker
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Returns
	 *
	 * @return Response/piwik.shuttertools.com/piwik.js
	 */
	public function js()
	{
		$key = 'piwikJS';

		if (Cache::has($key))
		{
			return Cache::get($key);
		}

		// Download the javascript code, cache it, and return it
		try
		{
			$js = file_get_contents("http://{$this->trackerUrl}/piwik.js");

			Cache::put($js, $key, $this->cacheLifetime);

			return $js;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Piwik Proxy
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Build the Piwik PHP tracker using the HTTP API, and auth token
	 *
	 * @return Reponse/piwik.shuttertools.com/piwik.php
	 */
	public function proxy()
	{
		$request = Request::createFromGlobals();

		$ip = $request->getClientIp();
		$ua = $request->server->get('HTTP_USER_AGENT', 'PiwikTrackerProxy');
		$al = $request->server->get('HTTP_ACCEPT_LANGUAGE', '');

		// Assemble the query string
		$params = [];
		$qs  = $request->getQueryString();
		parse_str($qs, $params);

		$params['token_auth'] = $this->token;
		$params['idsite'] = $this->tracking_id;
		$params['cip'] = $request->getClientIp();
		// $params['bots'] = 1;
		$params['rec'] = 1;

		$params = http_build_query($params);

		// Assemble the final url
		$url = "http://{$this->trackerUrl}/piwik.php?{$params}";

		// \Log::info('Piwik.php URL: ' . $url);

		// Setup a stream context
		$streamOptions = [
			'http' => [
				'user_agent'	=> $ua,
				'header'		=> "Accept-Language: $al\r\n",
				'timeout'		=> 10
			]
		];

		$streamContext = stream_context_create($streamOptions);

		// Call piwik to register the pageview
		try
		{
			return file_get_contents($url, 0, $streamContext);
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	 * Generates the query string in case it's not done by piwik.js
	 *
	 * @param  array $params
	 * @return array $params
	 */
	public function generateQueryString($items = [])
	{
		$request = Request::createFromGlobals();

		$ip = $request->getClientIp();
		$ua = $request->server->get('HTTP_USER_AGENT', 'PiwikTrackerProxy');
		$al = $request->server->get('HTTP_ACCEPT_LANGUAGE', '');

		$params = [
			'idsite'		=> $this->tracking_id,
			'token_auth'	=> $this->token,
			'rec'			=> 1,
			// 'action_name'	=>
			'apiv'			=> 1,
			// 'bots'			=> 1,
			'cip'			=> $request->getClientIp(),
			'rand'			=> str_random(6),
		];

		return $params;
	}

	/*
	|--------------------------------------------------------------------------
	| Piwik JS Tracker
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Returns the theme Piwik javascript
	 *
	 * @return Response
	 */
	public function getCode()
	{
		// We need to change some parameters in the tracking code depending on
		// if we run in hidden mode or not
		if ($this->hidden) {
			$trackerUrl = $this->project->website_url;
			$piwikPhp   = 'piwik.php';
			$piwikJs	= 'piwik.js';
		}
		else
		{
			return null;
		}

		// Assemble the tracking code
		$piwikProxy = "
			<script type=\"text/javascript\">
			var _paq = _paq || [];
			_paq.push(['trackPageView']);
			_paq.push(['enableLinkTracking']);
			(function() {
			var u=(('https:' == document.location.protocol) ? 'https' : 'http') + '://{$trackerUrl}';
			_paq.push(['setTrackerUrl', u+'/{$piwikPhp}']);
			_paq.push(['setSiteId', '{$this->tracking_id}']);
			var d = document,
				g = d.createElement('script'),
				s = d.getElementsByTagName('script')[0];
			g.type = 'text/javascript';
			g.defer = true;
			g.async = true;
			g.src = u + '/{$piwikJs}';
			s.parentNode.insertBefore(g, s);
			})();
			</script>";

		return $piwikProxy; //implode(PHP_EOL, array_map('trim', explode(PHP_EOL, $piwikProxy)));
	}
}