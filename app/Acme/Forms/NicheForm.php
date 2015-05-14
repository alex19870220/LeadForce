<?php namespace Acme\Forms;

class NicheForm extends FormValidator {

	/**
	 * Validation rules for niches
	 *
	 * @var array
	 */
	protected $rules = [
		'label'			=> 'required|min:3',
		'keyword_main'	=> 'required|min:3'
	];

}