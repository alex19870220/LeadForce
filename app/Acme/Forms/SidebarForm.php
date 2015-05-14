<?php namespace Acme\Forms;

class SidebarForm extends FormValidator {

	/**
	 * Validation rules for users
	 *
	 * @var array
	 */
	protected $rules = [
		'label'			=> 'required|min:3',
	];

}