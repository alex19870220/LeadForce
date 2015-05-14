<?php

class NotificationController extends AdminController {

	/**
	 * User dashboard page.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// Show the page
		return View::make('backend.account.notifications');
	}

}