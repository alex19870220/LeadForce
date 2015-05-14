<?php namespace Acme\Projects;

use Niche;
use Spinner;

class NicheStats {

	/**
	 * @var Niche $niche
	 */
	protected $niche;

	/**
	 * @var string $nicheContent
	 */
	protected $nicheContent;

	/**
	 * @var integer $spinCount The number of times to spin the content for the averages
	 */
	protected $spinCount = 15;

	/**
	 * @var array $stats
	 */
	protected $stats = [];

	/**
	 * @var array $originalStats
	 */
	protected $originalStats = [
		'hash' => '',

		'has' => [
			'content'		=> true,
			'excerpt'		=> false,
		],

		'totals' => [
			'words'			=> 0,
			'mkw'			=> 0,
			'ckw'			=> 0,
			'city'			=> 0,
			'state'			=> 0,
			'googlemap'		=> 0,
			'header'		=> 0,
		],

		'averages' => [
			'words'			=> 0,
			'mkw'			=> 0,
			'ckw'			=> 0,
			'city'			=> 0,
			'state'			=> 0,
			'googlemap'		=> 0,
			'header'		=> 0,
		],
	];

	/**
	 * Calculate all the total/average stats and return the Niche
	 *
	 * @param  Niche  $niche
	 * @return Niche  $niche
	 */
	public static function calculateStats(Niche $niche)
	{
		// Check if Niche has content
		if(empty($niche->content))
		{
			$niche->stats = null;
		}
		else
		{
			$obj = new static;

			$obj->niche = $niche;
			$obj->nicheContent = strtolower(strip_tags($niche->content));

			// Reset the stats
			$obj->resetStats();

			// Calculate all stats
			$obj->getTotals();
			$obj->getAverages();

			// Set the new stats
			$niche->stats = $obj->stats;
		}

		return $niche;
	}

	/**
	 * Resets the stats
	 *
	 * @return array $this->stats
	 */
	protected function resetStats()
	{
		$this->stats = $this->originalStats;

		return $this->stats;
	}

	/**
	 * Calculate all the totals
	 *
	 * @return array $this->stats['totals']
	 */
	public function getTotals()
	{
		$nicheContent = $this->nicheContent;

		// Totals
		$this->stats['totals']['words']		= str_word_count($nicheContent);
		$this->stats['totals']['mkw']		= substr_count($nicheContent, '[mkw');
		$this->stats['totals']['ckw']		= substr_count($nicheContent, '[ckw');
		$this->stats['totals']['city']		= substr_count($nicheContent, '[city');
		$this->stats['totals']['state']		= substr_count($nicheContent, '[st');
		$this->stats['totals']['googlemap']	= substr_count($nicheContent, '[googlemap');
		$this->stats['totals']['header']	= substr_count($nicheContent, '[header');

		return $this->stats['totals'];
	}

	/**
	 * Calculate all the averages
	 *
	 * @return array $this->stats['averages']
	 */
	public function getAverages()
	{
		$nicheContent = $this->nicheContent;

		// Loop spinning the content to find the average
		$averageCalcs = [];

		for($x = 0;$x < $this->spinCount;$x++)
		{
			$spunContent = Spinner::parse($nicheContent);

			$averageCalcs['words'][$x]		= str_word_count($spunContent);
			$averageCalcs['mkw'][$x]		= substr_count($spunContent, '[mkw');
			$averageCalcs['ckw'][$x]		= substr_count($spunContent, '[ckw');
			$averageCalcs['city'][$x]		= substr_count($spunContent, '[city');
			$averageCalcs['state'][$x]		= substr_count($spunContent, '[st');
			$averageCalcs['googlemap'][$x]	= substr_count($spunContent, '[googlemap');
			$averageCalcs['header'][$x]		= substr_count($spunContent, '[header');
		}

		// Averages
		$this->stats['averages']['words']		= round(array_sum($averageCalcs['words']) / count($averageCalcs['words']));
		$this->stats['averages']['mkw']			= round(array_sum($averageCalcs['mkw']) / count($averageCalcs['mkw']));
		$this->stats['averages']['ckw']			= round(array_sum($averageCalcs['ckw']) / count($averageCalcs['ckw']));
		$this->stats['averages']['city']		= round(array_sum($averageCalcs['city']) / count($averageCalcs['city']));
		$this->stats['averages']['state']		= round(array_sum($averageCalcs['state']) / count($averageCalcs['state']));
		$this->stats['averages']['googlemap']	= round(array_sum($averageCalcs['googlemap']) / count($averageCalcs['googlemap']));
		$this->stats['averages']['header']		= round(array_sum($averageCalcs['header']) / count($averageCalcs['header']));

		return $this->stats['averages'];
	}

}