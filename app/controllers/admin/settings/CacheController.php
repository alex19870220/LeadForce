<?php

class CacheController extends AdminController {

	public function getIndex()
	{
		return View::make('backend.cache.dashboard');
	}
}