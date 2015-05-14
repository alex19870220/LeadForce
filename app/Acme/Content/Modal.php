<?php namespace Acme\Content;

use View;

class Modal {

	protected $html;

	protected $modal;

	function __construct()
	{
		$this->html = View::make('frontend.partials.modal');
	}

}