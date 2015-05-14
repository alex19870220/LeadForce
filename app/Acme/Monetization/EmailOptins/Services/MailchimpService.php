<?php namespace Acme\Monetization\EmailOptins\Services;

use Acme\Monetization\EmailOptins\EmailOptinInterface;
use Acme\Monetization\EmailOptins\Services\Mailchimp;

class MailchimpService implements EmailOptinInterface {

	/**
	 * @var Mailchimp
	 */
	protected $mailchimp;

	/**
	 * @param Mailchimp $mailchimp
	 */
	function __construct($apiKey = '')
	{
		$mailchimp = new Mailchimp($apiKey, []);
		$this->mailchimp = $mailchimp;
	}

	/**
	 * Subscribe a user to a Mailchimp list
	 *
	 * @param $listName
	 * @param $email
	 * @return mixed
	 */
	public function subscribeTo($list, $email)
	{
		return $this->mailchimp->lists->subscribe(
			$list,
			['email' => $email],
			null, // merge vars
			'html', // email type
			true, // require double opt in?
			true // update existing customers?
		);
	}

	/**
	 * Unsubscribe a user from a Mailchimp list
	 *
	 * @param $listName
	 * @param $email
	 * @return mixed
	 */
	public function unsubscribeFrom($listName, $email)
	{
		return $this->mailchimp->lists->unsubscribe(
			$this->lists[$listName],
			['email' => $email],
			false, // delete the member permanently
			false, // send goodbye email?
			false // send unsubscribe notification email?
		);
	}

}