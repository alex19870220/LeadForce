<?php

class SpintaxController extends AdminController {

	/**
	 * @var string $headersPath
	 */
	protected $headersPath = '/spintax/headers/';

	/**
	 * @var string $headersSource
	 */
	protected $headersSource = 'source/headers.txt';

	/**
	 * @var integer $headersPerFile
	 */
	protected $headersPerFile = 10;

	/**
	 * Get dashbord
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$path = storage_path() . $this->headersPath;
		$currentHeaders = File::files($path);

		return View::make('backend.spintax.dashboard', compact('currentHeaders'))->with(['headersPerFile' => $this->headersPerFile]);
	}

	/**
	 * Recompiles the spintax headers into bite-sized chunks
	 *
	 * @return Response
	 */
	public function getRecompileHeaders()
	{
		$path = storage_path() . $this->headersPath . $this->headersSource;

		if(! File::exists($path))
		{
			Flash::error('The headers file is missing!!!!!!!');

			return Redirect::route('spintax');
		}

		// Grab the headers
		$headers = File::get($path);

		// Check shortcodes
		$headers = str_ireplace('[ckw]', '[CKW]', $headers);
		$headers = str_ireplace('[city]', '[city]', $headers);
		$headers = str_ireplace('[state]', '[state]', $headers);
		$headers = str_ireplace('[st]', '[st]', $headers);

		// Do fucking magic
		$headers = explode(PHP_EOL, $headers);
		$headers = array_map('trim', $headers);

		shuffle($headers);
		shuffle($headers);
		shuffle($headers);

		// Setup the header files
		$headerCount = count($headers);
		$headersPerFile = $this->headersPerFile;
		$headersArray = [];
		$headersWereAt = 0;
		$headersTotal = 0;
		$filePath = storage_path() . $this->headersPath;
		$fileNumber = 1;

		// Goooooooo!
		for($x = 0;$x < $headerCount;$x++)
		{
			if(empty($headers[$x]))
				continue;

			// Check the spintax count
			$checkSpintaxLeft = 0;
			$checkSpintaxRight = 0;
			$checkSpintaxLeft = substr_count($headers[$x], '{');
			$checkSpintaxRight = substr_count($headers[$x], '}');

			if($checkSpintaxLeft !== $checkSpintaxRight)
				continue;

			$headersArray[] = $headers[$x];
			$headersWereAt++;

			// Create a file when the max is reached
			if($headersWereAt == $headersPerFile || $x == $headerCount)
			{
				File::put("{$filePath}{$fileNumber}.txt", implode(PHP_EOL, $headersArray));
				$headersArray = [];
				$headersWereAt = 0;
				$fileNumber++;
				$headersTotal++;
			}
		}

		Flash::success("Alright you fucking pimp, you just put out {$fileNumber} files of {$headersPerFile} headers each, totaling {$headersTotal}. BOO YA~!");

		return Redirect::route('spintax');
	}
}