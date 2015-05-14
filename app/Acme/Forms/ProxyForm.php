<?php namespace Acme\Forms;

class ProxyForm extends FormValidator {

	/**
	 * Validation rules for proxies
	 *
	 * @var array
	 */
	protected $rules = [
		'ip'			=> 'required|min:3',
		'port'			=> 'required|min:3'
	];

}