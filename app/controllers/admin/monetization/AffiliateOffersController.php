<?php

class AffiliateOffersController extends AdminController {

	public function getIndex()
	{
		// Show the page
		return View::make('backend.monetization.affiliateoffers');
	}
}