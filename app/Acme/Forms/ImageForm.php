<?php namespace Acme\Forms;

class ImageForm extends FormValidator {

	/**
	 * Validation rules for users
	 *
	 * @var array
	 */
	protected $rules = [
		'image'			=> 'required|image',
		// 'image'			=> 'required|mimes:jpeg,jpg,bmp,png',
		'type'			=> 'required|min:3',
	];

}