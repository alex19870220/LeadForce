<?php namespace Acme\Monetization\Leadgen;

use LeadgenForm;
use Symfony\Component\DomCrawler\Crawler;

class LeadgenFormHelper {

	/**
	 * @var LeadgenForm $leadgenForm
	 */
	protected $leadgenForm;

	/**
	 * @var string $formLabelClass The class for field labels
	 */
	private $formLabelClass = 'control-label';

	/**
	 * @var string $formFieldClass The class for input fields
	 */
	private $formFieldClass = 'form-control';

	/**
	 * The different form styles
	 *
	 * @var array
	 */
	protected $formStyles = [
		'default' => [
			'label'			=> 'Default',
			'show_labels'	=> true,
		],
		'horizontal' => [
			'label'			=> 'Horizonal',
			'show_labels'	=> true,
		],
		'minimal' => [
			'label'			=> 'Minimal',
			'show_labels'	=> false,
		],
	];

	/*
	|--------------------------------------------------------------------------
	| Main Functions
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Display LeadgenForm by ID
	 *
	 * @param  integer $leadgenFormId
	 * @return string
	 */
	public function displayForm($leadgenFormId, $style = 'default')
	{
		// Check if the email optin exists
		if (is_null($leadgenForm = LeadgenForm::find($leadgenFormId)))
		{
			return false;
		}

		// Start form HTML output
		$formHtml = '';

		$formHtml = $this->buildFormHtml($leadgenForm->form_fields);

		return $formHtml;
	}

	/*
	|--------------------------------------------------------------------------
	| Output Form
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Builds a form's HTML and outputs all fields
	 *
	 * @param  array  $leadgenFormFields
	 * @param  string $style
	 * @return string
	 */
	public function buildFormHtml($leadgenFormFields, $style = 'default')
	{
		if(! is_array($leadgenFormFields))
			return 'Form fields must be an array!';

		if(! $this->checkIfFormStyleExists($style))
			$style = 'default';

		$output = '';

		foreach($leadgenFormFields as $formField)
		{
			$output .= $this->formFieldHtml($formField, $style);
		}

		return $output;
	}

	/**
	 * Outputs the HTML for a form field
	 *
	 * @param  stdClass $formField
	 * @param  string   $style
	 * @return string
	 */
	protected function formFieldHtml($formField, $style)
	{
		if(! is_object($formField))
			return 'Form field must be an stdClass!';

		$output = '<div class="form-group">';

		// Label
		$output .= $this->formLabel($formField, $style);
		// Field
		$output .= $this->formField($formField, $style);

		$output .= '</div>';

		return $output;
	}

	/**
	 * Outputs a form field's label
	 *
	 * @param  stdClass $formField
	 * @param  string   $style
	 * @return string
	 */
	protected function formLabel($formField, $style)
	{
		$labelClass = $this->formLabelClass;

		if($style == 'minimal')
		{
			$labelClass .= ' sr-only';
		}
		// Horizontal styling
		elseif($style == 'horizontal')
		{
			$labelClass .= ' col-md-4';
		}

		return '<label class="' . $labelClass . '" for="' . $formField->name . '">' . $formField->label . '</label>';
	}

	protected function formField($formField, $style)
	{
		$output = '';

		// Horizontal styling
		if($style == 'horizontal')
		{
			$output .= '<div class="col-md-8">';
		}

		// Input - Text
		if(isset($formField->inputs))
		{
			$output .= $this->formInputText($formField->inputs);
		}
		// Input - Select
		elseif(isset($formField->selects))
		{
			$output .= $this->formInputSelect($formField->selects);
		}
		// Input - Checkboxes
		elseif(isset($formField->checkboxes))
		{
			$output .= $this->formInputCheckboxes($formField->checkboxes);
		}
		// Input - Textarea
		elseif(isset($formField->textarea))
		{
			$output .= $this->formInputTextarea($formField->textarea);
		}
		// Input - Radio
		// elseif($formField->textarea)
		// {
		// 	$output = $this->formInputTextarea($formField);
		// }

		// Horizontal styling
		if($style == 'horizontal')
		{
			$output .= '</div>';
		}

		return $output;
	}

	/**
	 * Check if form style exists
	 *
	 * @param  string $style
	 * @return bool
	 */
	private function checkIfFormStyleExists($style)
	{
		if(! isset($this->formStyles[$style]))
		{
			return false;
		}

		return true;
	}

	/*
	|--------------------------------------------------------------------------
	| Output Form Fields
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns text input HTML
	 *
	 * @param  array $formFields
	 * @param  string $output
	 * @return string $output
	 */
	private function formInputText($formFields, $output = '')
	{
		foreach($formFields as $formField)
		{
			$output .= '<input type="text" class="' . $this->formFieldClass . '" name="' . $formField->name . '">';
		}

		return $output;
	}

	/**
	 * Returns select input HTML
	 *
	 * @param  array $formFields
	 * @param  string $output
	 * @return string $output
	 */
	private function formInputSelect($formFields, $output = '')
	{
		foreach($formFields as $formField)
		{
			$output .= '<select class="' . $this->formFieldClass . '" name="' . $formField->name . '">';

			// Select options
			foreach($formField->options as $formFieldOption)
			{
				$output .= '<option value="' . $formFieldOption->value . '">' . $formFieldOption->label . '</option>';
			}

			$output .= '</select>';
		}

		return $output;
	}

	/**
	 * Returns checkbox input HTML
	 *
	 * @param  array $formFields
	 * @param  string $output
	 * @return string $output
	 */
	private function formInputCheckboxes($formFields, $output = '')
	{
		foreach($formFields as $formField)
		{
			$output .= '<div class="checkbox">';
			$output .= '<label class="checkbox-custom">';
			$output .= '<input type="checkbox" name="' . $formField->name . '">';
			$output .= '<i class="fa fa-fw fa-square-o"></i> ' . $formField->label;
			$output .= '</label>';
			$output .= '</div>';
		}

		return $output;
	}

	/**
	 * Returns textarea HTML
	 *
	 * @param  array $formFields
	 * @param  string $output
	 * @return string $output
	 */
	private function formInputTextarea($formFields, $output = '')
	{
		foreach($formFields as $formField)
		{
			$output .= '<textarea class="' . $this->formFieldClass . '" name="' . $formField->name . '"></textarea>';
		}

		return $output;
	}

	/**
	 * Returns radio options HTML
	 *
	 * @param  array $formFields
	 * @param  string $output
	 * @return string $output
	 */
	private function formInputRadios($formFields, $output = '')
	{
		foreach($formFields as $formField)
		{
			$output .= '<div class="radio">';
			$output .= '<label class="radio-custom">';
			$output .= '<input type="radio" name="' . $formField->name . '">';
			$output .= '<i class="fa fa-circle-o"></i> ' . $formField->label;
			$output .= '</label>';
			$output .= '</div>';
		}

		return $output;
	}

	/*
	|--------------------------------------------------------------------------
	| Parse HTML form
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Parses the raw form HTML into an array
	 *
	 * @param  string $rawHtml
	 * @return array
	 */
	public function parseRawFormHtml($formHtml)
	{
		// Instantiate the DomCrawler
		$crawler = new Crawler($formHtml);

		// <form>
		$form = $crawler->filter('body form#data_form');

		// Parse all form fields
		$formFieldsArray = $form->filter('tr')->each(function (Crawler $node, $i) {
			$formFieldsArray = [];

			// Input label
			$formFieldsArray['label'] = trim($node->filter('td')->eq(0)->text());
			$formFieldsArray['label'] = trim($formFieldsArray['label'], ':');

			// Check if label is empty
			if($formFieldsArray['label'] == '')
			{
				return;
			}

			// Parse the Form Fields
			$formFieldsArray = $this->parseFormFields($node, $formFieldsArray);

			return $formFieldsArray;
		});

		// Input - Hidden
		$formHiddenFields = $form->filter('input[type="hidden"]')->each(function (Crawler $node, $i)
		{
			return [
				'type'	=> $node->attr('type'),
				'name'	=> $node->attr('name'),
				'value'	=> trim($node->attr('value')),
			];
		});
		if($formHiddenFields == []) unset($formHiddenFields);

		// Filter Form Fields & reindex
		$formFieldsArray = array_values(array_filter($formFieldsArray));

		// Setup action/hidden_fields & FormData array
		$formData = [
			'action'	=> trim($form->attr('action')),
			'hidden'	=> $formHiddenFields,
			'fields'	=> $formFieldsArray,
		];

		// Debug
		// echo '<pre>';
		// print_r($formData);
		// echo '</pre>';
		// dd($formData);

		return $formData;
	}

	/**
	 * Parses all form fields & adds data to the array
	 *
	 * @param  Crawler $node
	 * @param  array $formFieldsArray
	 * @return array
	 */
	private function parseFormFields($node, &$formFieldsArray)
	{
		// Input td
		$inputTd = $node->filter('td')->last();

		// Input - HTML
		$formFieldsArray['input_html'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', trim($inputTd->html()));

		// Input - Text
		$formFieldsArray['inputs'] = $inputTd->filter('input[type="text"]')->each(function (Crawler $node, $i) use (&$formFieldsArray)
		{
			$formFieldsArray['name'] = $node->attr('name');
			return [
				'type'	=> $node->attr('type'),
				'name'	=> $node->attr('name'),
			];
		});

		// Textarea
		$formFieldsArray['textarea'] = $node->filter('td')->last()->filter('textarea')->each(function (Crawler $node, $i) use (&$formFieldsArray)
		{
			$formFieldsArray['name'] = $node->attr('name');
			return [
				'name' => $node->attr('name'),
			];
		});

		// Input - Select
		$formFieldsArray['selects'] = $node->filter('td')->last()->filter('select')->each(function (Crawler $node, $i) use (&$formFieldsArray)
		{
			$formFieldsArray['name'] = $node->attr('name');
			return [
				'name'		=> $node->attr('name'),
				'options'	=> $node->filter('option')->each(function (Crawler $node, $i) {
					return [
						'value'	=> trim($node->attr('value')),
						'label'	=> $node->text(),
						];
					}),
			];
		});

		// Input - Checkbox
		$formFieldsArray['checkboxes'] = $inputTd->filter('input[type="checkbox"]')->each(function (Crawler $node, $i) use (&$formFieldsArray)
		{
			$formFieldsArray['name'] = $node->attr('name');
			return [
				'name'		=> $node->attr('name'),
				'value'		=> trim($node->attr('value')),
			];
		});
		if($formFieldsArray['checkboxes'] == [])
		{
			unset($formFieldsArray['checkboxes']);
		}
		else
		{
			// Run through the checkbox labels & assign them
			$checkboxLabels = explode('<br>', $formFieldsArray['input_html']);
			foreach($checkboxLabels as $checkboxLabelKey => $checkboxLabelValue)
			{
				// If checkbox exists
				if(isset($formFieldsArray['checkboxes'][$checkboxLabelKey]))
				{
					$formFieldsArray['checkboxes'][$checkboxLabelKey]['label'] = str_replace('&nbsp;', '', trim(strip_tags($checkboxLabelValue)));
				}
			}
		}

		// Check empty inputs
		if($formFieldsArray['inputs'] == []) unset($formFieldsArray['inputs']);
		if($formFieldsArray['textarea'] == []) unset($formFieldsArray['textarea']);
		if($formFieldsArray['selects'] == []) unset($formFieldsArray['selects']);

		return $formFieldsArray;
	}

	/*
	|--------------------------------------------------------------------------
	| Form Styles
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Form Styles - return StdClass
	 *
	 * @return array
	 */
	public function getFormStyles()
	{
		return $this->formStyles;
	}

	/**
	 * Return the styling of a Leadgen Form if it exists
	 *
	 * @param  string $formType
	 * @return StdClass
	 */
	public function getFormStyle($key)
	{
		if(isset($this->formStyles[$key]))
		{
			return (object) $this->formStyles[$key];
		}
		return false;
	}
}