<?php namespace Acme\Interfaces;

interface FireQueueInterface {

	/**
	 * Fire the queue
	 *
	 * @param  StdClass Object $job
	 * @param  array $data
	 */
	public function fire($job, $data);
}