<?php

use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class ProjectImage extends \Eloquent {

	use PresentableTrait;

	/**
	 * Mass assignment protection
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * Model presenter
	 *
	 * @var string
	 */
	protected $presenter = 'Acme\Presenters\ProjectImagePresenter';

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'images';
}