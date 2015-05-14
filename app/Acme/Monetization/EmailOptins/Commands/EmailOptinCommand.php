<?php namespace Acme\Monetization\EmailOptins;

class EmailOptinCommand {

	public $project_id;

	public $form_id;

	public $email;

	function __construct()
	{
		$this->project_id	= $project_id;
		$this->form_id		= $form_id;
		$this->email		= $email;
	}
}