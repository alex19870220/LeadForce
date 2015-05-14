<?php namespace Acme\Content\Shortcode\Shortcodes;

use Cache;
use File;
use Shortcode;

class Header {

	/**
	 * @var string $headerPath
	 */
	protected $path = '/spintax/headers';

	protected $headersPath;

	/**
	 * @var File $headersFiles
	 */
	protected $headerFiles;

	/**
	 * @var string $filePath
	 */
	protected $filePath;

	/**
	 * @var string $cacheKey
	 */
	protected $cacheKey;

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		$this->path = storage_path() . $this->path;
		// $this->headerFiles = File::files($this->path);
		// dd($this->headerFiles);
	}

	/**
	 * Returns a spintax of shortcode-parsed headers
	 *
	 * @param  string $attr
	 * @param  string $content
	 * @param  string $name
	 * @return string
	 */
	public function register($attr, $content = null, $name = null)
	{
		$group = array_get($attr, 'group', 0);

		return $this->getHeadersSpun($group);
	}

	/**
	 * Returns the header in raw spintax
	 *
	 * @return string
	 */
	public function getHeadersSpun($file = 0)
	{
		// $headerFiles = $this->headerFiles;
		// array_values($headerFiles);
		$path = "{$this->path}/{$file}.txt";

		if(! isset($path) || ! File::exists($path))
			return '<span class="text-danger">Header file does not exist!</span>';

		$headers = File::get($path);

		return Shortcode::compile(array_spin($headers, PHP_EOL));
	}

}