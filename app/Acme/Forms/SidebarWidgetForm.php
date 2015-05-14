<?php namespace Acme\Forms;

class SidebarWidgetForm extends FormValidator {

	/**
	 * Validation rules for users
	 *
	 * @var array
	 */
	protected $rules = [
		'label'			=> 'required|min:3',
		'type'			=> 'required',
		'view'			=> 'required_if:type,hardcoded',
		'contents'		=> 'required_if:type,html',
		'form_id'		=> 'required_if:type,emailoptin,leadgen|integer'
	];

}