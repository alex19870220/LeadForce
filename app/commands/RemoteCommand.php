<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RemoteCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'remote:deploy';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Deploys the Laravel project to the remote sever.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$me = $this;
		$remote = $this->argument('remote');
		$config = app()->config['remote.connections.'.$remote];

		$commands = [
			'cd '.$config['root'],
			'git checkout -f',
			'git pull -f',
			'php artisan cache:clear',
		];

		if($this->option('migrate'))
			$commands[] = 'php artisan migrate';

		if($this->option('composer'))
			$commands[] = 'composer install --no-dev';

		SSH::into($remote)->run(

			$commands,

			function($line) use ($me) {
				$me->info($line);
			}
		);

		$this->info('All done!');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('remote', InputArgument::OPTIONAL, 'Define which remote to connect to.', 'production'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('composer', null, InputOption::VALUE_NONE, 'Execute composer install.', null),
			array('migrate', null, InputOption::VALUE_NONE, 'Execute php artisan migrate.', null),
		);
	}

}
