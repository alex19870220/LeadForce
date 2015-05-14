<?php namespace Acme\Forms;

class HomeAdvisorForm extends FormValidator {

	/**
	 * Validation rules for users
	 *
	 * @var array
	 */
	protected $rules = [
		'spreadsheet'		=> 'required',
		'url_type'			=> 'required|in:iframe,redirect',
	];

}