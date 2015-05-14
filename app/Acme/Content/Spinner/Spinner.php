<?php namespace Acme\Content\Spinner;

use Acme\Content\Spinner\Parser;

/**
 * Spintax - A helper class to process Spintax strings.
 * @name Spintax
 * @author Brandon Johnson - Added static method & unit testing
 */
class Spinner {

	/**
	 * @var array $path
	 */
	public $path = [];

	function __construct()
	{
		echo 'Acme\Content\Spinner\Spinner<br />';
	}

	/**
	 * Static function to return spintax
	 *
	 * @param  string $text
	 * @return string
	 */
	public static function spin($text)
	{
		$spinner = new Spinner();

		return $spinner->process($text);
	}

	/**
	 * Process the spintax
	 *
	 * @param  string $text
	 * @return string
	 */
	protected function process($text)
	{
		return preg_replace_callback(
			'/\{(((?>[^\{\}]+)|(?R))*)\}/x',
			array($this, 'replace'),
			$text
		);
	}

	/**
	 * Callback replace function
	 *
	 * @param  string $text
	 * @return string
	 */
	protected function replace($text)
	{
		$text = $this->process($text[1]);
		$parts = explode('|', $text);
		return $parts[mt_rand(0, count($parts)-1)];	// Using mt_rand
	}

}