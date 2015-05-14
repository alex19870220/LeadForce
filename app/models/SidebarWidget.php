<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class SidebarWidget extends \Eloquent {

	use SoftDeletingTrait, PresentableTrait;

	/**
	 * Soft deleting dates column
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * Mass assignment protection
	 *
	 * @var array
	 */
	protected $fillable = ['label', 'slug', 'title', 'type', 'view', 'contents'];

	/**
	 * Model presenter
	 *
	 * @var string
	 */
	protected $presenter = 'Acme\Presenters\SidebarWidgetPresenter';

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'widgets';

	/**
	 * The types of SidebarWidgets that are possible
	 *
	 * @var array
	 */
	public $widgetTypes	= [
		'html'			=> 'Custom HTML',
		'hardcoded'		=> 'Hard Coded',
		'leadgen'		=> 'Lead Manager',
	];

	/**
	 * The View for custom HTML widgets
	 *
	 * @var string
	 */
	protected $customWidgetView = 'frontend.widgets.custom';

	/**
	 * Default attributes
	 *
	 * @var array
	 */
	protected $attributes = [
		'view'			=> 'frontend.widgets.',
	];

	/*
	|--------------------------------------------------------------------------
	| Relationshits
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Relationship with Sidebar
	 *
	 * @return Sidebar
	 */
	public function sidebar()
	{
		return $this->belongsToMany('Sidebar', 'sidebar_widget', 'widget_id', 'sidebar_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Sidebar/Widget jQuery Stuff
	|--------------------------------------------------------------------------
	|
	|
	|
	*/



}