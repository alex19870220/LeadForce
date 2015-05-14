<?php namespace Acme\Forms;

class UserProfileForm extends FormValidator {

	/**
	 * Validation rules for users
	 *
	 * @var array
	 */
	protected $rules = [
		'first_name'		=> 'required|min:3',
		'last_name'			=> 'required|min:3',
		'username'			=> 'required|alpha_num',
		'website'			=> 'url',
		'gravatar'			=> 'email',
	];

}