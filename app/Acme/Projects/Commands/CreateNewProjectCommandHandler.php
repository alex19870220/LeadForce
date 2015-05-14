<?php namespace Acme\Projects\Commands;

use Acme\Repositories\ProjectRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateNewProjectCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * @var ProjectRepository $ProjectRepository
	 */
	protected $ProjectRepository;

	/**
	 * Instantiate the Object
	 *
	 * @param ProjectRepository $ProjectRepository
	 */
	function __construct(ProjectRepository $ProjectRepository)
	{
		$this->ProjectRepository = $ProjectRepository;
	}

	/**
	 * Handle the Command
	 *
	 * @param  array $command
	 * @return Project
	 */
	public function handle($command)
	{
		$project = $this->ProjectRepository->storeNewProject();

		$this->dispatchEventsFor($project);

		return $project;
	}
}