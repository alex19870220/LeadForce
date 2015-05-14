<?php namespace Acme\Presenters;

use Cache;
use Config;
use Laracasts\Presenter\Presenter;
use Request;
use Route;
use Spinner;
use URL;

class ProjectStatsPresenter extends Presenter {

	/**
	 * Returns the formatted Index count
	 *
	 * @return integer
	 */
	public function index_count()
	{
		return ($this->entity->index_count > 0) ? number_format($this->entity->index_count) : Config::get('acme.display.empty.number');
	}

	/**
	 * Returns the formatted Page count
	 *
	 * @return integer
	 */
	public function page_count()
	{
		return ($this->entity->page_count > 0) ? number_format($this->entity->page_count) : Config::get('acme.display.empty.number');
	}

	/**
	 * Returns the formatted Indexed page count
	 *
	 * @return string
	 */
	public function indexCountFormatted()
	{
		$indexCount = $this->entity->index_count;

		if($indexCount > 999 && $indexCount <= 999999)
			return floor($indexCount / 1000) . 'k';

		if($indexCount > 999999)
			return number_format((float)$indexCount , 1, '.', '')/1000000 . 'm';

		return $indexCount;
	}

	/**
	 * Returns the formatted page count
	 *
	 * @return string
	 */
	public function pageCountFormatted()
	{
		$pageCount = $this->entity->page_count;

		if($pageCount > 999 && $pageCount <= 999999)
			return floor($pageCount / 1000) . 'k';

		if($pageCount > 999999)
			return number_format((float) $pageCount , 1, '.', '')/1000000 . 'm';

		return $pageCount;
	}

	/**
	 * Returns the percent of pages indexed
	 *
	 * @return int
	 */
	public function indexPercent()
	{
		$indexCount = ($this->entity->index_count) ? $this->entity->index_count : '0';
		$pageCount  = ($this->entity->page_count) ? $this->entity->page_count : '100';

		return indexPercent($indexCount, $pageCount);
	}
}