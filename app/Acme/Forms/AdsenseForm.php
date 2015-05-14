<?php namespace Acme\Forms;

class AdsenseForm extends FormValidator {

	/**
	 * Validation rules for users
	 *
	 * @var array
	 */
	protected $rules = [
		'label'			=> 'required|min:3',
		'publisher_id'	=> 'required|min:20',
		// 'ads'			=> 'integer|min:10|max:10',
	];

}