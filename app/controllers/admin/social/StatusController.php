<?php

use Acme\Forms\Social\PublishStatusForm;
use Acme\Social\Statuses\LeaveCommentOnStatusCommand;
use Acme\Social\Statuses\PublishStatusCommand;
use Acme\Repositories\StatusRepository;
use Laracasts\Commander\CommanderTrait;

class StatusController extends \BaseController {

	use CommanderTrait;

	/**
	 * @var StatusRepository
	 */
	protected $statusRepository;

	/**
	 * @var PublishStatusForm
	 */
	protected $publishStatusForm;

	/**
	 * @param PublishStatusForm $publishStatusForm
	 * @param StatusRepository $statusRepository
	 */
	function __construct(PublishStatusForm $publishStatusForm, StatusRepository $statusRepository)
	{
		$this->publishStatusForm = $publishStatusForm;
		$this->statusRepository = $statusRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$statuses = $this->statusRepository->getAllForUser(Auth::user());

		return View::make('statuses.index', compact('statuses'));
	}

	/*
	|--------------------------------------------------------------------------
	| Posting Statuses
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Save a new status
	 *
	 * @return Response
	 */
	public function postNewStatus()
	{
		$this->publishStatusForm->validate(Input::only('body'));

		$body = e(Input::get('body'));

		$this->execute(PublishStatusCommand::class, ['body' => $body, 'userId' => Sentry::getUser()->id]);

		Flash::success('Your status has been updated!');

		return Redirect::back();
	}

	/*
	|--------------------------------------------------------------------------
	| Replying to Statuses
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Save a new status
	 *
	 * @return Response
	 */
	public function postReplyToStatus()
	{
		$this->publishStatusForm->validate(Input::only('body'));

		$body = e(Input::get('body'));

		$this->execute(LeaveCommentOnStatusCommand::class, ['userId' => Sentry::getUser()->id, 'status_id' => Input::get('status_id'), 'body' => $body]);

		Flash::success('Your comment has been posted');

		return Redirect::back();
	}


}