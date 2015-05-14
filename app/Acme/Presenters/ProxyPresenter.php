<?php namespace Acme\Presenters;

use Laracasts\Presenter\Presenter;
use Proxy;
use Route;
use Spinner;
use URL;

class ProxyPresenter extends Presenter {

	/**
	 * Returns a styled label describing the Proxy's active status
	 *
	 * @return string
	 */
	public function proxyStatus()
	{
		if($this->entity->active == false)
		{
			return '<span class="label label-danger">Inactive</span>';
		}
		else
		{
			return '<span class="label label-success">Active</span>';
		}
	}

	/**
	 * Returns a styled label describing the Proxy's last result
	 *
	 * @return string
	 */
	public function lastResult()
	{
		if($this->entity->last_result == 200)
		{
			return '<span class="label label-success">' . $this->entity->last_result . '</span>';
		}
		elseif($this->entity->last_result >= 400)
		{
			return '<span class="label label-danger">' . $this->entity->last_result . '</span>';
		}
		else
		{
			return '<span class="label label-warning">' . $this->entity->last_result . '</span>';
		}
	}

	/**
	 * Returns the Proxy's formatted last load time
	 *
	 * @return string
	 */
	public function lastLoadTime()
	{
		$loadTime = round($this->entity->last_load_time, 2);

		if($loadTime <= 2)
		{
			return $loadTime;
		}
		elseif($loadTime <= 5)
		{
			return '<span class="text-warning">' . $loadTime . '</span>';
		}
		else
		{
			return '<span class="text-danger">' . $loadTime . '</span>';
		}
	}

}