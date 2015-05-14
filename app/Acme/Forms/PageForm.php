<?php namespace Acme\Forms;

class PageForm extends FormValidator {

	/**
	 * Validation rules for Pages
	 *
	 * @var array
	 */
	protected $rules = [
		// Required
		'project_id'	=> 'required|numeric',
		'title'			=> 'required|min:3',
		'menu_label'	=> 'required|min:3',
		'page_order'	=> 'required|integer',

		// Not required
		'icon'			=> 'alpha_dash'
	];

}