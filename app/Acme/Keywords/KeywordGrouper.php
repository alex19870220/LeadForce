<?php namespace Acme\Keywords;

use File;
use RecursiveIteratorIterator;

class KeywordGrouper {

	/**
	 * @var array $keywords
	 */
	public $keywords = [];

	/**
	 * @var array $output
	 */
	public $groupedList = [];

	/**
	 * Returns the grouped array after cleaning
	 *
	 * @return array
	 */
	public static function groupKeywords($keywords = [])
	{
		$obj = new static;

		if(empty($keywords))
			return false;

		$obj->keywords = $keywords;
		$obj->doGrouping();
		$obj->removeStopwords();

		return $obj->groupedList;
	}

	/**
	 * Do the damn thing
	 *
	 * @return $output
	 */
	public function doGrouping(){

		$keywords = $this->keywords;

		if(empty($keywords) || $keywords == array() || $keywords == '')
			return false;

		$ar = array();
		$full = array();
		$output = array();
		$textAr = $keywords;
		$textAr = array_filter($textAr, 'trim');
		$textAr = array_unique($textAr);

		foreach($textAr as $line){
			$ar[] = explode(" ", ($line));  // feed array with separated keywords
		}

		$it =  new \RecursiveIteratorIterator(new \RecursiveArrayIterator($ar));
		$l = iterator_to_array($it, false);  // multi array into one array
		$l = (array_count_values($l)); // count keywords
		asort($l); //sort

		$arr = array_diff($l, array('1', '2', '3', '4')); // remove repeating words less than 4

		$i = 1;

		foreach(array_keys($arr) as $paramName){
			foreach($textAr as $key){
				if(substr_count($key, $paramName)>0){
					if (!in_array($key, $full))
						$output[$paramName][$key] = $key;
				}
			}
			$i++;
		}

		$this->groupedList = $output;

		return $output;
	}

	/**
	 * Removes groups that are stopwords
	 *
	 * @return array
	 */
	public function removeStopwords()
	{
		$groupedList = $this->groupedList;

		// Stopwords
		$stopwords = File::get(storage_path() . '/lists/StopWords.txt');
		$stopwords = explode(PHP_EOL, $stopwords);
		$stopwords = array_map('trim', $stopwords);

		foreach($groupedList as $group => $groupArray){

			foreach($stopwords as $word){

				// Remove stopwords and group keys smaller than 4 chars
				if($group == $word || strlen($group) < 4)
				{
					unset($groupedList[$group]);
					continue 2;
				}

				$groupedList[$group] = array_values($groupedList[$group]);
			}

		}

		$this->groupedList = $groupedList;

		return $groupedList;
	}

}

?>