<?php namespace Acme\Forms;

class ProjectForm extends FormValidator {

	/**
	 * Validation rules for projects
	 *
	 * @var array
	 */
	protected $rules = [
		'label'				=> 'required|min:3',
		'website_title'		=> 'required|min:3',
		'website_url'		=> 'required|min:3',
		// 'niche_id'			=> 'required|numeric',
	];

}