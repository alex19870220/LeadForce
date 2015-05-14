<?php namespace Acme\Monetization\EmailOptins;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class EmailOptinCommandHandler {

	use DispatchableTrait;

	/**
	 * Handle the command
	 *
	 * @param  Commander $command
	 * @return boolean
	 */
	public function handle($command)
	{
		$project_id	= $command->project_id;
		$email		= $command->email;

		// Do stuff
	}

}