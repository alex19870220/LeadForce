<?php namespace Acme\Piwik;

use Config;
use Request;
use Route;

class PiwikHelper {

	/**
	 * Query strings to save as site searches
	 *
	 * @var array $queryStringsToKeep
	 */
	protected $queryStringsToKeep = ['page', 'search', 'q', 's'];

	/**
	 * Instantite the object
	 */
	function __construct()
	{
		$this->project		= Route::input('projectSlug');
		$this->requestUrl	= Request::url();
		$this->tracking_id	= $this->project->tracking_id;
		$this->token		= Config::get('acme.api.piwik.token');
	}

	/**
	 * Builds a query string from the current request
	 *
	 * @param  array $request
	 * @return string
	 */
	public static function buildQueryString($request)
	{
		$obj = new static;

		$params = $obj->getParams($request);

		// dd($obj->requestUrl);

		return http_build_query($params);
	}

	/**
	 * Gets the parameters from query string and organizes them
	 *
	 * @param  array $request
	 * @return array
	 */
	public function getParams($request)
	{
		$rf = $request->server->get('HTTP_REFERER', null);

		return = [
			'idsite'		=> $this->tracking_id,
			'token_auth'	=> $this->token,
			'rec'			=> 1,
			'bots'			=> 1,
			'urlref'		=> $rf,
			'apiv'			=> 1,
			'rand'			=> str_random(6),
		];
	}
}