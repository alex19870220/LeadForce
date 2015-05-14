<?php namespace Acme\Presenters;

use Config;
use Laracasts\Presenter\Presenter;

class IndexerPresenter extends Presenter {

	/**
	 * Displays the current status of the Indexer in a label
	 *
	 * @return string
	 */
	public function status()
	{
		if($this->entity->active == false)
		{
			$status = ($this->entity->complete == true) ? '<span class="label label-success">Complete</span>' : '<span class="label label-default">New</span>';
		}
		else
		{
			$status = ($this->entity->complete == true) ? '<span class="label label-success">Complete</span>' : '<span class="label label-info">Processing</span>';
		}

		return $status;
	}

	/**
	 * Returns the formatted Indexed page count
	 *
	 * @return string
	 */
	public function indexCountFormatted()
	{
		return ($this->entity->project->stats->first()) ? $this->entity->project->stats->first()->present()->index_count : Config::get('acme.display.empty.number');
	}

	/**
	 * Returns the formatted page count
	 *
	 * @return string
	 */
	public function pageCountFormatted()
	{
		return ($this->entity->project->stats->first()) ? $this->entity->project->stats->first()->present()->page_count : Config::get('acme.display.empty.number');
	}

	/**
	 * Returns the percent of pages indexed
	 *
	 * @return int
	 */
	public function indexPercent()
	{
		$indexCount = ($this->entity->project->stats->first()) ? $this->entity->project->stats->first()->index_count : '0';
		$pageCount  = ($this->entity->project->stats->first()) ? $this->entity->project->stats->first()->page_count : '100';

		return indexPercent($indexCount, $pageCount);
	}

	/**
	 * Outputs the HTML for the Indexer's progress
	 * Based on (IndexCount / Page Count * 100)
	 *
	 * @return string $html
	 */
	public function progressBar()
	{
		$indexPercent  = $this->indexPercent();
		$progressColor = $this->progressColor($indexPercent);

		$html = '<div data-toggle="tooltip" data-original-title="' . $indexPercent . '%" class="progress progress-xs progress-striped m-t-sm m-b-none block">';
		$html .= '<div class="progress-bar '. $progressColor .'" style="width: ' . $indexPercent . '%;"></div>';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Returns a color for the progress bar
	 *
	 * @param  integer $percent
	 * @return string
	 */
	public function progressColor($percent = 0)
	{
		$progressColor = 'bg-dark';

		// > 0%
		if($percent >= 0)
			$progressColor = 'bg-danger dk';

		if($percent >= 15)
			$progressColor = 'bg-danger';

		if($percent >= 30)
			$progressColor = 'bg-warning dk';

		if($percent >= 45)
			$progressColor = 'bg-warning';

		if($percent >= 60)
			$progressColor = 'bg-success';

		if($percent >= 75)
			$progressColor = 'bg-success dk active';

		return $progressColor;
	}

}