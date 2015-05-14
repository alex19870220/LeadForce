<?php namespace Acme\Forms;

class ContentForm extends FormValidator {

	/**
	 * Validation rules for content
	 *
	 * @var array
	 */
	protected $rules = [
		'label'   => 'required|min:3',
		'keywords' => 'required|min:3'
	];

}