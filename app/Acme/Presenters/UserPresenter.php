<?php namespace Acme\Presenters;

use Laracasts\Presenter\Presenter;
use URL;

class UserPresenter extends Presenter {

	/**
	 * Returns the user full name, it simply concatenates
	 * the user first and last name.
	 *
	 * @return string
	 */
	public function fullname()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	/**
	 * Grab the title of a user, and optionally put it in a label
	 * @param  boolean $label set this to true to output the title as a label
	 * @return string
	 */
	public function title($label = false)
	{
		$permissions = $this->entity->getMergedPermissions();
		$title = '';

		if(isset($permissions['admin']) && $permissions['admin'] == 1)
			return (! $label) ? 'Admin' : '<label class="label label-danger m-l-xs">Admin</label>';

		if(isset($permissions['user']) && $permissions['user'] == 1 || $permissions == array())
			return (! $label) ? 'Member' : '<label class="label label-primary m-l-xs">Member</label>';

		return (! $label) ? 'Guest' : '<label class="label label-default m-l-xs">Guest</label>';
	}

	/**
	 * Returns the user Gravatar image url.
	 *
	 * @return string
	 */
	public function getGravatar($size = 30)
	{
		$email = md5($this->email);

		return "//www.gravatar.com/avatar/{$email}?s={$size}";
	}

	/*
	|--------------------------------------------------------------------------
	| Social Stuff
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Returns the User's profile URL
	 *
	 * @return string
	 */
	public function profileUrl()
	{
		if(! empty($this->entity->username))
			return URL::route('user/profile', $this->entity->username);

		return '#';
	}

	/**
	 * @return string
	 */
	public function followersCount()
	{
		return $this->entity->followers()->count();
	}

	/**
	 * @return string
	 */
	public function followingCount()
	{
		return  $this->entity->following()->count();
	}

	/**
	 * @return string
	 */
	public function statusCount()
	{
		$count = $this->entity->statuses()->count();
		$plural = str_plural('Status', $count);

		return "{$count} {$plural}";
	}
}