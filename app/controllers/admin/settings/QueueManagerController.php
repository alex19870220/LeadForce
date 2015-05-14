<?php

class QueueManagerController extends AdminController {

	/**
	 * Get the Queues dashboard
	 *
	 * @return Response
	 */
	public function getDashboard()
	{
		// Gets Queue list:
		// $list = (Queue::getRedis()->command('LRANGE',['queues:default', '0', '-1']));

		// Gets number of items in Queue:
		$queue_length = (Queue::getRedis()->command('LLEN',['queues:default']));

		return View::make('backend.settings.queues');
	}

	/**
	 * Returns the number of Queue jobs waiting to be processed
	 *
	 * @return Response
	 */
	public function getQueueJobCount()
	{
		$queue_length = (Queue::getRedis()->command('LLEN',['queues:default']));

		$color = 'light';

		if($queue_length >= 5)
			$color = 'info';

		if($queue_length >= 10)
			$color = 'warning';

		if($queue_length >= 15)
			$color = 'danger';

		$output = '<i class="fa fa-cogs"></i>';
		$output .= '<span class="badge badge-sm up bg-' . $color . '">' . $queue_length . '</span>';

		return $output;
	}
}