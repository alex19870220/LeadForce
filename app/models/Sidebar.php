<?php

use Laracasts\Presenter\PresentableTrait;

class Sidebar extends \Eloquent {

	use PresentableTrait;

	/**
	 * Mass assignment protection
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'sidebars';

	/**
	 * Model presenter
	 *
	 * @var string
	 */
	protected $presenter = 'Acme\Presenters\SidebarPresenter';

	/*
	|--------------------------------------------------------------------------
	| Relationshits
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Return the projects that belong to this niche
	 *
	 * @return Project
	 */
	public function project()
	{
		return $this->belongsToMany('Project');
	}

	/**
	 * Relationship with SidebarWidget
	 *
	 * @return SidebarWidget
	 */
	public function widgets()
	{
		return $this->belongsToMany('SidebarWidget', 'sidebar_widget', 'sidebar_id', 'widget_id')->withPivot('widget_order');
		// return $this->widgets;
	}

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Widgets - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getWidgetsListAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Widgets - Serialize
	 *
	 * @param Array $value array of widgets
	 */
	public function setWidgetsListAttribute(Array $value) {
		$jsonWidgets = json_encode($value);
		if($jsonWidgets) {
			$this->attributes['widgets_list'] = $jsonWidgets;
		} else {
			throw new InvalidArgumentException("Unable to convert Widgets object to JSON");
		}
	}

}