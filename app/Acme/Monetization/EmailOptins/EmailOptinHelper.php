<?php namespace Acme\Monetization\EmailOptins;

use OptinForm;
use SidebarWidget;
use Route;
use View;

class EmailOptinHelper {

	/**
	 * @var array $optinOptins caching the optins
	 */
	protected $emailOptins = [];

	/*
	|--------------------------------------------------------------------------
	| Subscribtions
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Show success message when the form works
	 *
	 * @return string
	 */
	public function getSubscribeSuccess()
	{
		return '<div class="text-center"><strong>Thank you for subscribing! Please check your email for a confirmation email.</strong></div>';
	}

}