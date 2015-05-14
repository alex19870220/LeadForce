<?php

use Laracasts\Presenter\PresentableTrait;

class LeadgenForm extends \Eloquent {

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
	protected $presenter = 'Acme\Presenters\LeadgenFormPresenter';

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'lead_forms';

	/**
	 * Disable timestamps
	 *
	 * @var boolean
	 */
	public $timestamps = false;

	/*
	|--------------------------------------------------------------------------
	| Relationshits
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Relationshit with User
	 *
	 * @return User
	 */
	public function owner()
	{
		return $this->hasOne('User', 'user_id');
	}

	/**
	 * Relationshit with Project
	 *
	 * @return Project
	 */
	// public function project()
	// {
	// 	return $this->belongsToMany('Project', 'optin_form_project');
	// }

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Form Fields - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getFieldsAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Form Fields - Serialize
	 *
	 * @param Array $value array of fields
	 */
	public function setFieldsAttribute(Array $fields) {
		$jsonFields = json_encode($fields);
		if($jsonFields) {
			$this->attributes['fields'] = $jsonFields;
		} else {
			throw new InvalidArgumentException("Unable to convert `fields` object to JSON");
		}
	}

	/**
	 * Form Data - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getFormDataAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Form Data - Serialize
	 *
	 * @param Array $value array of form data
	 */
	public function setFormDataAttribute(Array $formData) {
		$jsonFormData = json_encode($formData);
		if($jsonFormData) {
			$this->attributes['form_data'] = $jsonFormData;
		} else {
			throw new InvalidArgumentException("Unable to convert `form_data` object to JSON");
		}
	}

}