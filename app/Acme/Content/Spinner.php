<?php namespace Acme\Content;

use Acme\Content\Spinner\Content;
use Acme\Content\Spinner\Parser;

/**
 * Spintax - A helper class to process Spintax strings.
 * @name Spintax
 * @author Brandon Johnson - Added static method & unit testing
 */
class Spinner {

	/**
	 * Parser::parse's returned object: Content()
	 *
	 * @var Content $spintax
	 */
	protected $spintax;

	/**
	 * @var array $path
	 */
	protected $path = [];

	/**
	 * Spins provided spintax
	 *
	 * @param  string $text
	 * @return string $string
	 */
	public function parse($text = '')
	{
		$this->spintax = Parser::parse($text);

		// return $this->spintax;
		return $this->spintax->generate();
	}

	/**
	 * Generates a random new path for the spintax
	 *
	 * @return array $path
	 */
	public function generatePath()
	{
		$path = [];
		$this->spintax->generate($path);

		return $path;
	}

	/**
	 * Output the spintax
	 *
	 * @param  array $path
	 * @return string
	 */
	public function getSpunText(array $path)
	{
		$output = $this->spintax->generate($path);

		// Check for spintax errors
		if(strpos($output, '{') !== false || strpos($output, '}') !== false)
		{
			throw new \InvalidArgumentException('Parsed spintax is outputting spintax characters! ("{", "}", or "|")');
		}

		return $output;
	}

	/*
	|--------------------------------------------------------------------------
	| Old Spinner
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Oldschool spin function
	 *
	 * @param  string $text
	 * @return string
	 */
	public function oldSpin($text)
	{
		return $this->process($text);
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
			[$this, 'replace'],
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