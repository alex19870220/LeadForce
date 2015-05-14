<?php

use Laracasts\Presenter\PresentableTrait;

class OptinForm extends \Eloquent {

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
	protected $presenter = 'Acme\Presenters\OptinFormPresenter';

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'optin_forms';

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
	 * Relationshit with Project
	 *
	 * @return Project
	 */
	public function project()
	{
		return $this->belongsToMany('Project', 'optin_form_project');
	}

	/*
	|--------------------------------------------------------------------------
	| Form Types
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Return each form type
	 *
	 * @return array
	 */
	public function getFormTypes()
	{
		return $this->formTypes;
	}

	/**
	 * Return each of a form type's subtypes
	 *
	 * @param  string $formType
	 * @return array
	 */
	public function getFormSubTypes($formType)
	{
		return $this->formTypes[$formType]['subtypes'];
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
	 * Options - Unserialize
	 *
	 * @param  string $value serialized array
	 * @return array
	 */
	public function getOptionsAttribute($value) {
		if(is_array($value))
		{
			$value = json_encode($value);
		}
		return json_decode($value);
	}

	/**
	 * Options - Serialize
	 *
	 * @param Array $value array of options
	 */
	public function setOptionsAttribute(Array $options) {
		$jsonOptions = json_encode($options);
		if($jsonOptions) {
			$this->attributes['options'] = $jsonOptions;
		} else {
			throw new InvalidArgumentException("Unable to convert options object to JSON");
		}
	}

	/**
	 * Get option value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getOption($key)
	{
		return object_get($this->options, $key, null);
	}

	/**
	 * Sets an option
	 *
	 * @param string $key
	 * @param string $value
	 */
	public function setOption($key, $value)
	{
		if(object_get($this->options, $key))
		{
			array_set($this->options, $key, $value);
			// $this->options[$key] = $value;
		} else {
			throw new InvalidArgumentException("The option [$key] does not exist.");
		}
		return $this;
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
	 * Get Form Data value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getFormData($key)
	{
		return object_get($this->form_data, $key, null);
	}

	/**
	 * Form Data - Serialize
	 *
	 * @param Array $value
	 */
	public function setFormDataAttribute(Array $formData) {
		$jsonFormData = json_encode($formData);
		if($jsonFormData) {
			$this->attributes['form_data'] = $jsonFormData;
		} else {
			throw new InvalidArgumentException("Unable to convert form data object to JSON");
		}
	}

}