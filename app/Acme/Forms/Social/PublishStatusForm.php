<?php namespace Acme\Forms\Social;

use Acme\Forms\FormValidator;

class PublishStatusForm extends FormValidator {

	/**
	 * Validation rules for the publish status form.
	 *
	 * @var array
	 */
	protected $rules = [
		'body'    => 'required|min:3',
	];

}