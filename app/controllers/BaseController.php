<?php

class BaseController extends Controller {

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Clockwork //
		if (App::environment('local'))
		{
			$this->beforeFilter(function()
			{
				Event::fire('clockwork.controller.start');
			});
			$this->afterFilter(function()
			{
				Event::fire('clockwork.controller.end');
			});
		}
		// Clockwork //

		// Fetch the User object, or set it to false if not logged in
		if (Sentry::check()) {
			$user = Sentry::getUser();
		}
		else
		{
			$user = false;
		}

		// Sharing is caring
		View::share('currentUser', $user);

		// MessageBag
		$this->messageBag = new Illuminate\Support\MessageBag;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}