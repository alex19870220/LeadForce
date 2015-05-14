<?php

class AssetController extends ViewProjectController {

	/**
	 * Returns robots.txt
	 *
	 * @return Response
	 */
	public function getRobotsTxt()
	{
		$contents = View::make('frontend.assets.robotstxt');
		$response = Response::make($contents, 200);
		$response->header('Content-Type', 'text/plain');
		return $response;
	}

}