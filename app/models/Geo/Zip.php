<?php

use Laracasts\Presenter\PresentableTrait;

class Zip extends \Eloquent {

	use PresentableTrait;

	protected $fillable = [];

	/**
	 * The database table used by this model
	 * @var string
	 */
	protected $table = 'geo_zips';

	protected $presenter = 'Acme\Presenters\ZipPresenter';



}