<?php namespace Acme\Forms;

class LeadgenFormForm extends FormValidator {

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