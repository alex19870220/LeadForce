<?php

/**
 * Chance
 *
 * @param  integer $chance percent chance to return true
 * @return boolean
 */
function chance($chance = 50)
{
	if(is_numeric($chance) && $chance > 0 && $chance <= 100){
		if (mt_rand(1,100)>$chance) {
			return false;
		} else {
			return true;
		}
	} else {
		throw new Exception('The chance percent must be between 0 and 100.');
	}
}

/**
 * Returns the current domain's TLD
 *
 * @return string
 */
function get_tld()
{
	return substr(Request::root(), strrpos(Request::root(), ".")+1);
}

/**
 * Button loading state
 *
 * @return string
 */
function btnLoading()
{
	return 'data-loading-text="Loading..."';
}

/**
 * Checks if string is valid json.
 *
 * @param $string
 * @return bool
 * @author Andreas Glaser
 */
function is_json($string)
{
	// make sure provided input is of type string
	if (!is_string($string)) {
		return false;
	}

	// trim white spaces
	$string = trim($string);

	// get first character
	$firstChar = substr($string, 0, 1);

	// get last character
	$lastChar = substr($string, -1);

	// check if there is a first and last character
	if (!$firstChar || !$lastChar) {
		return false;
	}

	// make sure first character is either { or [
	if ($firstChar !== '{' && $firstChar !== '[') {
		return false;
	}

	// make sure last character is either } or ]
	if ($lastChar !== '}' && $lastChar !== ']') {
		return false;
	}

	// let's leave the rest to PHP.
	// try to decode string
	json_decode($string);

	// check if error occurred
	$isValid = json_last_error() === JSON_ERROR_NONE;

	return $isValid;
}

/**
 * Removes new lines and tabs from a string
 * Used for the page title mainly
 *
 * @param  string $string
 * @return string
 */
function trimSpace($string)
{
	return str_replace(["\r", "\n", "\t"], '', $string);
}

/**
 * Returns the percent of the website that is indexed
 *
 * @param  integer $indexed
 * @param  integer $totalPages
 * @return integer
 */
function indexPercent($indexed = 0, $totalPages = 0)
{
	if($indexed < 1 || $totalPages < 1 ) return 0;

	$percent = round((($indexed / $totalPages) * 100), 0);

	return ($percent > 100) ? 100 : $percent;
}

/**
 * Mask part of a string
 *
 * <code>
 * echo maskString('4012888888881881', 6, 4, '*');
 * </code>
 *
 * @param   string  $s	  String to process
 * @param   integer $start  Number of characters to leave at start of string
 * @param   integer $end	Number of characters to leave at end of string
 * @param   string  $char   Character to mask string with
 * @return  string
 */
function maskString($s, $start, $end, $char = 'X') {
	$middle = '';
	for ($i = 0; $i < strlen($s) - $start - $end; $i++) {
		$middle .= $char;
	}
	return preg_replace('/^(d{' . $start . '})(d+.)(d{' . $end . '})$/', '${1}' . $middle . '${3}', $s);
}

/**
 * Outputs an array with all of the theme colors & variants
 *
 * @return array
 */
function listThemeColors()
{
	return [
		'colors' => [
			'bg-light',	'bg-dark',
			'bg-black',	'bg-primary',
			'bg-success','bg-info',
			'bg-warning','bg-danger',
		],
		'variants' => [
			'dker',
			'dk',
			'',
			'lt',
			'lter',
		],
	];
}

/**
 * Explodes an array and returns it in spintax
 *
 * @param  Array  $array	Arry to be spun
 * @param  string $del		The delimiter
 * @return string			Array in spintax
 */
function array_spin($array, $del = ',')
{
	$array = (! is_array($array)) ? array_map('trim', explode($del, $array)) : array_map('trim', $array);
	return '{'.implode('|', $array).'}';
}

/**
 * Outputs the checked code for radios based on the info matching
 *
 * @param  string $key
 * @param  string $attempt
 * @return checked or null
 */
function checked_radio($key, $attempt)
{
	return ($key == $attempt) ? ' checked="checked"' : null;
}

/**
 * Adds HTML for a Bootrstrap 3 tooltip
 *
 * @param  string $text
 * @return string
 */
function tooltip($text, $position = null)
{
	if(! is_null($position) && in_array($position, ['top', 'right', 'bottom', 'left']))
		$position = 'data-placement="' . $position . '"';

	return 'data-toggle="tooltip" ' . $position . ' data-original-title="' . e($text) . '"';
}

/**
 * Adds the HTML for a popover, and replaces quotes with single quotes
 *
 * @param  string $content
 * @param  string $placement
 * @return string
 */
function popover($content, $placement = 'top')
{
	return 'data-container="body" data-toggle="popover" data-html="true" data-placement="' . $placement . '" data-content="' . str_replace('"', '\'', $content) . '"';
}

/**
 * Outputs HTML attributes based on given array
 *
 * @param  array  $array
 * @return string
 */
function htmlattributes(array $array)
{
	$output = '';
	foreach($array as $key => $value)
	{
		$output .= (! empty($value)) ? $key . '="' . $value . '" ' : $key . ' ';
	}
	return $output;
}