<?php

/**
 * Frontend - <li> links with auto-active
 *
 * @return string
 */
HTML::macro('liLinkRoute', function($name, $title = null, $parameters = array(), $attributes = array()){
	$active = ( URL::current() == URL::route($name, $parameters) ) ? ' class="active"':'';
	return '<li'.$active.'>' . HTML::linkRoute($name, $title, $parameters, $attributes) . '</li>';
});

/**
 * Backend - Sub-Navigation Menu Links
 * {{ HTML::liLinkNav('routeName', 'Link Text') }}
 *
 * @return string
 */
HTML::macro('liLinkSubnavPage', function($name, $title = null, $parameters = array(), $attributes = array()){
	$active = ( URL::current() == URL::route($name, $parameters) ) ? ' active':'';
	return '<li  class="b-b'.$active.'">' . htmlspecialchars_decode(HTML::linkRoute($name, '<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> ' . $title, $parameters, $attributes)) . '</li>';
});

/**
 * Backend - Navigation Menu Links
 * {{ HTML::liLinkNav('routeName', 'Link Text') }}
 *
 * @return string
 * @uses  HTML::linkRoute
 */
HTML::macro('liLinkNav', function($name, $title = null, $parameters = array(), $attributes = array()){
	$active = ( URL::current() == URL::route($name) ) ? ' class="active"':'';
	return '<li'.$active.'>' . htmlspecialchars_decode(HTML::linkRoute($name, '<i class="i i-dot"></i><span> ' . $title . '</span>', $parameters, $attributes)) . '</li>';
});

// Backup of above
// HTML::macro('liLinkNav', function($name, $title = null, $parameters = array(), $attributes = array()){
// 	$active = ( URL::current() == URL::route($name, $parameters) ) ? ' class="active"':'';
// 	return '<li'.$active.'>' . htmlspecialchars_decode(HTML::linkRoute($name, '<i class="fa fa-angle-right"></i><span> ' . $title . '</span>', $parameters, $attributes)) . '</li>';
// });

/**
 * Creates a Radio Option choice
 * $options = [
 * 'option|Option Label|html attributes'
 * ];
 * {{ HTML::optionRadio('option', $options, 'Choose Your Type') }}
 *
 * @var array
 */
HTML::macro('optionRadio', function($name, $options = array(), $title = null, $default = null, $helpBlock = null){
	$output = '<div class="form-group">';
	$output .= '<label class="col-md-3 control-label" for="' . $name . '">' . $title . '</label>';
	$output .= '<div class="col-md-9">';

	foreach($options as $option)
	{
		// value|Option Label
		$option = explode('|', $option);
		$option = array_map('trim', $option);
		$attributes = (! isset($option[2])) ? null : $option[2];

		$output .= '<div class="radio i-checks m-t-none">';
		$output .= '<label>';
		$output .= '<input type="radio" name="' . $name . '" value="'. $option[0] . '"' . checked_radio($option[0], $default) . ' ' . $attributes . '>';
		$output .= "<i></i> {$option[1]}";
		$output .= '</label>';
		$output .= '</div>';
	}

	if(! is_null($helpBlock))
		$output .= '<span class="help-block"><i class="fa fa-exclamation-circle text-danger"></i> ' . $helpBlock . '</span>';

	$output .= '</div>';
	$output .= '</div>';

	return $output;
});

/**
 * Provides a stylish On-Off switch for simple options
 *
 * @var array
 */
HTML::macro('optionSwitch', function($name, $title = null, $checked = null){
	$checked = (! isset($checked) || $checked == false) ? '' : ' checked=""';

	$output = '<div class="form-group">';
	$output .= '<label class="col-md-3 control-label" for="' . $name . '">' . $title . '</label>';
	$output .= '<div class="col-md-9">';
	$output .= '<label class="switch">';
	$output .= '<input type="checkbox" name="' . $name . '"' . $checked . '>';
	$output .= '<span></span>';
	$output .= '</label>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
});