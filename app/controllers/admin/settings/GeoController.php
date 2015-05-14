<?php

class GeoController extends AdminController {

	/**
	 * Display a listing of the resource.
	 * GET /geo
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$geoStates = State::with([
			'counties' => function($q) {
				// The post_id foreign key is needed,
				// so Eloquent could rearrange the relationship between them
				$q->select( array(DB::raw("count(*) as county_count"), "state_id") )
					->groupBy("state_id");
				},
			'cities' => function($q) {
				// The post_id foreign key is needed,
				// so Eloquent could rearrange the relationship between them
				$q->select( array(DB::raw("count(*) as city_count"), "state_id") )
					->groupBy("state_id");
				}
			])->remember(Config::get('acme.cache.geo'))->orderBy('state', 'ASC')->get();

		return View::make('backend.geo.dashboard', compact('geoStates'));
	}

	/*
	|--------------------------------------------------------------------------
	| Random Update Functions
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Update all Cities first letter
	 *
	 * @return Response
	 */
	public function postCityLetters()
	{
		// Give us some time
		ini_set('max_execution_time', 300);

		$cities = City::where('letter', '=', '')->orderBy('city')->get();

		foreach($cities as $currentCity)
		{
			$city = City::findOrFail($currentCity->id);

			$city->letter = substr($currentCity->city, 0, 1);

			echo "{$currentCity->letter}<br />";

			if($currentCity->save())
			{
				$i++;
			}
		}

		Flash::success("{$i} cities' letters have been updated! {$cities->count()} were found.");

		return Redirect::route('geolocation');
	}

	/**
	 * Update City populations
	 *
	 * @return Response
	 */
	public function postCityPopulation()
	{
		// Give us some time
		ini_set('max_execution_time', 300);

		// Check file
		if(! Input::hasFile('csv'))
			return Redirect::back();

		$csv = Input::file('csv');

		// Check file
		if($csv->getClientOriginalExtension() !== 'csv' || ! $csv->isValid())
			return Redirect::back();

		// Get the CSV data and import it into the reader
		$csvData = File::get($csv->getRealPath());
		$reader = League\Csv\Reader::createFromString($csvData);
		$reader->setDelimiter(',');

		// Get ready to process the data, motherfucker!
		$populationCities = $reader
			->addFilter(function ($row) {
				return ! empty($row[0]); // Make sure the City/State isn't empty
			})
			->addFilter(function ($row) {
				return is_numeric($row[1]); // Make sure population is a number
			})
			// ->setLimit(50)
			->fetchAll();

		// Begin parsing the CSV
		foreach($populationCities as $populationCity)
		{
			// Get City/State
			unset($locations);
			$locations = explode(',', $populationCity[0]);

			if(! is_array($locations) || count($locations) < 2)
				return Redirect::back();

			$locations = array_map('strtolower', $locations);
			$locations = array_map('trim', $locations);

			// Make sure City and State aren't empty
			if(empty($locations[0]) || empty($locations[1]))
				continue;

			// Slug up the City/State
			$city = Str::slug($locations[0]);
			$state = Str::slug($locations[1]);

			// dd($locations);

			// Find the State
			$dbState = State::where('state', '=', $state)
				->orWhere('abbr', '=', $state)
				->first();

			// Make sure we found the State
			if(! $dbState)
				continue;

			// Find the City
			$dbCity = City::where('state_id', '=', $dbState->id)
				->where('slug', '=', $city)
				->first();

			// Make sure we found the City
			if(! $dbCity)
				continue;

			// Get population
			$population = $populationCity[1];

			// Save it to the City
			$dbCity->population = $population;
			$dbCity->save();
		}

		Flash::success('Cities\' populations have been updated!');

		return Redirect::route('geolocation');
	}

	/*
	|--------------------------------------------------------------------------
	| Import GeoLocation Database
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Handles importing of the countries from the CSV to the database
	 *
	 * @return Response
	 */
	public function postImportGeoLocationDB()
	{
		// Give us some time
		ini_set('max_execution_time', 3000);
		ini_set('memory_limit','512M');

		$GeoDBPath = app_path() . '/storage/geo/GeoLocationDatabase.csv';

		// Check if file exists
		if(File::exists($GeoDBPath) && $GeoLocationDB = File::get($GeoDBPath))
		{
			echo '<h2>Processing Data...</h2>';

			// Use the CSV tool and set options
			$reader = Reader::createFromString($GeoLocationDB);
			$reader->setDelimiter(',');

			// Get the header
			$headers = $reader->fetchOne();

			// Get the column numbers for each header
			$headers = array_values($headers);

			// Get ready to process the data, motherfucker!
			$reader = $reader
				->setOffset(1)
				->addFilter(function ($row) {
					return isset($row[1], $row[2], $row[3]); //we make sure the data are present
				})
				->addFilter(function ($row) {
					return $row[0] == 'US'; // Make sure it's a US state
				})
				// ->setLimit(50)
				->fetchAll();

			// Process all the geolocation data and create a nice fat array
			$data = $this->parseCSV($reader, $headers);

			// Test shit
			echo '<h3>Geolocation Data</h3><pre>';
			echo 'Processed States: '.count($data).'<br />';
			// print_r($data);
			echo '</pre>';

			echo '<h3>File & Data Info</h3><pre>';
			// Get filesize & convert to MB
			$file_size = round((File::size($GeoDBPath) / 1048576), 2);
			echo 'Filesize: '.$file_size.'MB<br />';
			echo 'Total Rows: '.number_format(count($reader)).'<br />';

			// Insert into database
			echo '<h2>Inserting Data into Database</h2>';

			/**
			 *
			 * --------------------------------------------------------------------------
			 * The Loop
			 * --------------------------------------------------------------------------
			 *
			 * State
			 * ..State Name
			 * ..State Abbr
			 * ..City
			 * ....City Name
			 * ....County
			 * ....ZIPs (array)
			 */

			// Grab all Cities first for Cache?
			// $citiesDB = City::all();

			/**
			 * ----------------------------
			 * States
			 * ----------------------------
			 */
			foreach($data as $state)
			{
				$stateId = $countyId = null;

				$checkState = State::where('state', '=', $state['state']);

				// Check if State exists
				if($checkState->count() == 0)
				{
					$newState = new State;
					$newState = $this->setStateData($newState, $state);
					$newState->save();

					$stateId = DB::getPdo()->lastInsertId();
				}
				else
				{
					$stateId = $checkState->pluck('id');
				}

				/**
				 * ----------------------------
				 * Counties
				 * ----------------------------
				 */
				foreach($state['counties'] as $county)
				{
					$countySlug = Str::slug($county['county']);

					$checkCounty = County::where('state_id', '=', $stateId)
						->where('slug', '=', $countySlug);

					// Check if County exists
					if($checkCounty->count() == 0)
					{
						$county['state_id'] = $stateId;

						$newCounty = new County;
						$newCounty = $this->setCountyData($newCounty, $county);
						$newCounty->save();

						$countyId = DB::getPdo()->lastInsertId();
					}
					else
					{
						$countyId = $checkCounty->pluck('id');
					}

					/**
					 * ----------------------------
					 * Cities
					 * ----------------------------
					 */
					foreach($county['cities'] as $city)
					{
						$city['stateId']		= $stateId;
						$city['countyId']		= $countyId;
						$city['letter']			= substr($city['city'], 0, 1);
						$city['slug']			= e(Str::slug($city['city']));
						$city['postal_codes']	= $city['zips'];

						$checkCity = City::where('state_id', '=', $stateId)
							->where('county_id', '=', $countyId)
							->where('slug', '=', $city['slug']);

						// Check if City exists
						if($checkCity->count() == 0)
						{
							$newCity = new City;
							$newCity = $this->setCityData($newCity, $city);
							$newCity->save();
						}
						else
						{
							// This is where we'd update the City data
						}

					} // End city foreach

				} // End county foreach

			} // End state foreach

		} // End File::checks()
		else
		{
			Flash::danger('The GeoLocation DB is missing or corrupt! Contact Brandon ASAP');

			return Redirect::route('geolocation');
		}

		Flash::success('GeoLocation Database successfully imported!');

		return Redirect::route('geolocation');
	}

	/*
	|--------------------------------------------------------------------------
	| Import GeoLocation Database - Setting Data
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Set State data
	 *
	 * @param State $setState
	 * @param array $stateData
	 */
	private function setStateData(State $setState, array $stateData)
	{
		$setState->country_id	= 1;
		$setState->state		= $state['state'];
		$setState->abbr			= $state['abbr'];
		$setState->slug			= e(Str::slug($state['state']));

		return $setState;
	}

	/**
	 * Set County data
	 *
	 * @param County $setCounty
	 * @param array  $countyData
	 */
	private function setCountyData(County $setCounty, array $countyData)
	{
		$setCounty->state_id	= $countyData['stateId'];
		$setCounty->county		= $countyData['county'];
		$setCounty->slug		= Str::slug( $countyData['county']);

		return $setCounty;
	}

	/**
	 * Set City data
	 *
	 * @param City  $setCity
	 * @param array $cityData
	 */
	private function setCityData(City $setCity, array $cityData)
	{
		$setCity->state_id		= $cityData['stateId'];
		$setCity->county_id		= $cityData['countyId'];
		$setCity->city			= $cityData['city'];
		$setCity->postal_codes	= serialize($cityData['zips']);
		$setCity->slug			= $cityData['slug'];
		$setCity->letter		= strtoupper($cityData['letter']);

		return $setCity;
	}

	/**
	 * Parse the CSV and create the huge array of data
	 *
	 * country	= country;
	 * region1 	= state;
	 * region2 	= county;
	 * locality = city;
	 * postcode	= zip code;
	 * hasc 	= abbreviations;
	 *
	 * @param  array  $reader
	 * @return array $data
	 */
	private function parseCSV(array $reader, array $headers)
	{
		// Test shit
		echo '<h3>Header Columns</h3><pre>';
		print_r($headers);
		echo '</pre>';

		// Setup column headers & keys
		$col = array(
			'country' 	=> array_search('country', $headers),
			'state' 	=> array_search('region1', $headers),
			'county' 	=> array_search('region2', $headers),
			'city' 		=> array_search('locality', $headers),
			'zip' 		=> array_search('postcode', $headers),
			'abbr'		=> array_search('hasc', $headers),
			);

		// Test shit
		echo '<h3>Column Header Keys</h3><pre>';
		print_r($col);
		echo '</pre>';

		$data = [];

		foreach ($reader as $row){
			$abbr = explode('.', $row[$col['abbr']]);

			// State name
			$data[$row[$col['state']]]['state']																						= $row[$col['state']];

			// State abbr
			if(is_array($abbr) && isset($abbr[1]) && strlen($abbr[1]) > 1 && !isset($data[$row[$col['state']]]['abbr'])){
				$data[$row[$col['state']]]['abbr'] = $abbr[1];
			}
			// County

			// $data[$row[$col['state']]]['cities'][$row[$col['city']]]['county']													= $row[$col['county']];
			$data[$row[$col['state']]]['counties'][$row[$col['county']]]['county']													= $row[$col['county']];

			// City
			$data[$row[$col['state']]]['counties'][$row[$col['county']]]['cities'][$row[$col['city']]]['city']						= $row[$col['city']];

			// Zip codes
			$data[$row[$col['state']]]['counties'][$row[$col['county']]]['cities'][$row[$col['city']]]['zips'][$row[$col['zip']]]	= $row[$col['zip']];

			// Show state data
			// echo $row[$col['state']] . ' - ' . $abbr[1] . '[' . $row[$col['abbr']] . ']<br />';
		}

		return $data;
	}

}