<?php namespace Acme\Forms;

use Illuminate\Support\MessageBag;
use Laracasts\Flash\Flash;

class FormValidationException extends \Exception {

	/**
	 * @var MessageBag
	 */
	protected $errors;

	/**
	 * @param string     $message
	 * @param MessageBag $errors
	 */
	function __construct($message, MessageBag $errors)
	{
		$this->errors = $errors;

		Flash::error('Form validation failed. Check the form you submitted for the errors.');

		parent::__construct($message);
	}

	/**
	 * Get form validation errors
	 *
	 * @return MessageBag
	 */
	public function getErrors()
	{
		return $this->errors;
	}

}