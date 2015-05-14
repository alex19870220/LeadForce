<?php

use \PiwikTracker;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PiwikController extends BaseController {

	/**
	 * @var string $visitorUrl the URL being viewed
	 */
	protected $visitorUrl;

	/**
	 * @var string $visitorRefUrl the referring URL
	 */
	protected $visitorRefUrl;

	/**
	 * Returns the Piwik javascript
	 *
	 * @return Response/js
	 */
	public function getJS()
	{
		$piwikJs = PiwikTracker::js();

		if (false === $piwikJs) {
			// We failed to get the javascript code
			return App::abort(500);
		}

		return Response::make($piwikJs, 200, ['Content-Type' => 'application/javascript']);
	}

	/**
	 * Returns the Piwik proxy
	 *
	 * @return Response/gif
	 */
	public function getPiwikProxy()
	{
		try
		{
			$piwikProxy = PiwikTracker::proxy();

			if (false === $piwikProxy) {
				// We failed to call the piwik tracker
				return App::abort(500);
			}

			return Response::make($piwikProxy, 200, ['Content-Type' => 'image/gif']);
		}
		catch (HttpException $e)
		{
			Log::error('PiwikProxy failed to load! Current URI: ' . Request::url());

			return null;
		}

	}

	/**
	 * Returns the Piwik HTTP API manually (for bots, molbile, noJS, etc)
	 *
	 * @return Response
	 */
	public function getPHP()
	{
		//
	}
}