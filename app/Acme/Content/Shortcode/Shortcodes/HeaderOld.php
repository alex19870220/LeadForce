<?php namespace Acme\Content\Shortcode\Shortcodes;

use Cache;
use Config;
use File;
use Route;
use Shortcode;
use Shortcodes;

class HeaderOld {

	/**
	 * @var string $headerPath
	 */
	protected $headerPath = '/spintax/headers.txt';

	/**
	 * @var string $filePath
	 */
	protected $filePath;

	/**
	 * @var string $headerSpintax
	 */
	protected $headerSpintax = '';

	/**
	 * @var string $cacheKey
	 */
	protected $cacheKey;

	/**
	 * Returns the header in raw spintax
	 *
	 * @return string
	 */
	public function getHeaderSpintax()
	{
		// echo '<br />Getting the header.txt file........<br />';
		// Get file path
		$path = storage_path() . $this->headerPath;

		if(! File::exists($path))
			return 'Header file not found!';

		$file = File::get($path);

		return array_spin($file, PHP_EOL);
	}

	/**
	 * Process the HUGE header spintax for output
	 *
	 * @return string $spintax
	 */
	public function parseSpintaxShortcodes()
	{
		$spintax = $this->getHeaderSpintax();

		return Shortcode::compile($spintax);
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
		return $this->parseSpintaxShortcodes();
	}

	/**
	 * Get the current Niche's ID
	 *
	 * @return integer
	 */
	protected function getNicheId()
	{
		$niche = Route::input('nicheSlug');

		if(! $niche)
		{
			$project = Route::input('projectSlug');
			return $project->niche->id;
		}

		return $niche->id;
	}

	// Function to remove small lines
	// foreach($this->headerSpintax as $line)
	// {
	// 	echo (strlen($line) > 80) ? $line . "<br />" : null;
	// }

	// Function to remove lines without matching spintax brackets
	// foreach($this->headerSpintax as $line)
	// {
	// 	// Reset numbers
	// 	$checkSpintaxLeft = 0;
	// 	$checkSpintaxRight = 0;
	// 	// Check for broken Spintax
	// 	$checkSpintaxLeft = substr_count($line, '{');
	// 	$checkSpintaxRight = substr_count($line, '}');

	// 	if(($checkSpintaxLeft == $checkSpintaxRight) && !empty($line)){
	// 		echo $line . "<br />";
	// 	}
	// }
	// dd('');
}