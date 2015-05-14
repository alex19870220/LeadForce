<?php namespace Acme\Forms\Frontend;

use Acme\Forms\FormValidator;

class EmailOptinForm extends FormValidator {

	/**
	 * Validation rules for email optins
	 *
	 * @var array
	 */
	protected $rules = [
		'email'		=> 'required|email',
		'fid'		=> 'required|integer',
	];

}