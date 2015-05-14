<?php namespace Acme\Content\Shortcode\Shortcodes;

use HTML;
use Shortcode;

class UnOrderedList {

	/**
	 * Returns an unordered list
	 *
	 * @param  array $attr
	 * @param  string $content
	 * @param  string $name
	 * @return string
	 */
	public function ul($attr, $content = null, $name = null)
	{
		$text = Shortcode::compile($content);
		$attributes = HTML::attributes($attr);

		return '<ul class="m-b-xl fa-ul m-t-lg m-l-none" . ' . $attributes . '>' . $text . '</ul>';
	}

	/**
	 * Returns a list item with a checkbox, or specified
	 *
	 * @param  array $attr
	 * @param  string $content
	 * @param  string $name
	 * @return string
	 */
	public function li($attr, $content = null, $name = null)
	{
		$icon = array_get($attr, 'icon', 'fa-check');
		$text = Shortcode::compile($content);

		return '<li class="m-b"><i class="fa fa-fw '. $icon . ' text-success"></i> ' . $text . '</li>';
	}
}