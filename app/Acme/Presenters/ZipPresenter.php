<?php namespace Acme\Presenters;

use Cache;
use Laracasts\Presenter\Presenter;
use Request;
use Route;
use Spinner;
use URL;

class ZipPresenter extends Presenter {

	protected $project;

	/**
	 * Constructor
	 *
	 * @param $entity
	 */
	function __construct($entity)
	{
		$this->project =	Route::input('projectSlug');

		parent::__construct($entity);
	}

}