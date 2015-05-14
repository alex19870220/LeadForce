<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use \Closure;

class ReQueueListenCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var	string
	 */
	protected $name = 'requeue:listen';

	/**
	 * The console command description.
	 *
	 * @var	string
	 */
	protected $description = 'The command to run Queues with better memory limits.';

	protected $memoryLimit = '512M';

	protected $queue = 'default';

	protected $tries = '2';

	protected $sleep = '3';

	protected $timeout = '300';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		ini_set('memory_limit', $this->memoryLimit);

		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		// Config::set('app.debug', false);

		$this->comment('=====================================');
		$this->comment('');
		$this->info('  Setting up Redis Queue Listener');
		$this->comment('');
		$this->info('  memory limit: ' . ini_get('memory_limit'));
		// $this->info('  environment:  ' . App::environment());
		$this->info('  queue:        ' . $this->queue);
		$this->info('  tries:        ' . $this->tries);
		$this->info('  sleep:        ' . $this->sleep);
		$this->info('  timeout:      ' . $this->timeout);
		// $this->info('  debug:                ' . Config::get('app.debug'));
		$this->comment('-------------------------------------');
		$this->comment('');

		$this->comment('=====================================');
		$this->comment('');
		$this->info('  Starting the Queue!');
		$this->comment('');
		$this->comment('-------------------------------------');
		$this->comment('');

		$this->call('queue:listen', [
				'--queue'	=> 'default',
				'--tries'	=> $this->tries,
				'--sleep'	=> $this->sleep,
				'--timeout'	=> $this->timeout,
				// '--env'		=> 'local',
			]);
	}
}