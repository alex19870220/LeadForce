<?php namespace Acme\Monetization\EmailOptins;

interface EmailOptinInterface {

	/**
	 * Subscribe a user to a newsletter list
	 *
	 * @param $listName
	 * @param $email
	 * @return mixed
	 */
	public function subscribeTo($listName, $email);

	/**
	 * Unsubscribe a user from a newsletter list
	 *
	 * @param $list
	 * @param $email
	 * @return mixed
	 */
	public function unsubscribeFrom($list, $email);

}