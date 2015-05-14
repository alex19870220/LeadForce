<?php namespace Acme\Monetization\HomeAdvisor;

use File;
use Flash;
use League\Csv\Reader;

class HomeAdvisorParser {

	/**
	 * @var integer  $userId
	 */
	protected $userId;

	/**
	 * @var string  $spreadsheet
	 */
	protected $spreadsheet;

	public function processSpreadsheet($spreadsheetPath)
	{
		// Give us some time
		ini_set('max_execution_time', 60);
		ini_set('memory_limit','256M');

		// Check the file
		if(! File::exists($spreadsheetPath))
		{
			Flash::error('File upload error!');

			return false;
		}

		// if(File::extension($spreadsheetPath) !== 'csv')
			// return false;

		// Check if file exists
		if($spreadsheet = File::get($spreadsheetPath))
		{
			// Use the CSV tool and set options
			$reader = Reader::createFromString($spreadsheet);
			$reader->setDelimiter(',');

			// Get the header
			$headers = $reader->fetchOne();

			// Get the column numbers for each header
			$headers = array_values($headers);

			// Get ready to process the data, motherfucker!
			$reader = $reader
				->setOffset(1)
				->addFilter(function ($row) {
					return isset($row[2], $row[3]); //we make sure the data is present
				})
				// ->setLimit(50)
				->fetchAll();

			// Process all the geolocation data and create a nice fat array
			$data = json_encode($this->parseCSV($reader, $headers));

			return $data;
		}

		Flash::error('There was a problem processing the spreadsheet!');

		return false;
	}

	protected function parseCSV(array $reader, array $headers)
	{
		if(count($reader) < 1)
			return false;

		// Setup column headers & keys
		$col = [
			'id'			=> array_search('ID', $headers),
			'ept_id'		=> array_search('EPT ID', $headers),
			'description' 	=> array_search('Description', $headers),
			'link'			=> array_search('Link', $headers),
			'create_date'	=> array_search('Create Date', $headers),
			];

		$data = [];

		foreach ($reader as $row)
		{
			$description = explode('_', $row[$col['description']]);
			$data[$description[0]] = $row[$col['link']];
		}

		// Sort the array
		ksort($data);

		return $data;
	}
}