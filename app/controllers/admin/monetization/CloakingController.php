<?php

class CloakingController extends AdminController {

	public function getIndex()
	{
		// Show the page
		return View::make('backend.monetization.cloaking');
	}
}