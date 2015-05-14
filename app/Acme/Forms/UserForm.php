<?php namespace Acme\Forms;

class UserForm extends FormValidator {

	/**
	 * Validation rules for users
	 *
	 * @var array
	 */
	protected $rules = [
		'first_name'       => 'required|min:3',
		'last_name'        => 'required|min:3',
		'email'            => 'required|email',
	];

}