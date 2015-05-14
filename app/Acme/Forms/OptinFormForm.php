<?php namespace Acme\Forms;

class OptinFormForm extends FormValidator {

	/**
	 * Validation rules for niches
	 *
	 * @var array
	 */
	protected $rules = [
		'label'			=> 'required|min:3',
		'title'			=> 'required|min:3',
	];

}