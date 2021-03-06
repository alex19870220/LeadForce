<?php namespace Acme\Presenters\Social;

use Laracasts\Presenter\Presenter;

class CommentPresenter extends Presenter {

	/**
	 * Display how long it has been since the publish date.
	 *
	 * @return mixed
	 */
	public function timeSincePublished()
	{
		return $this->entity->created_at->diffForHumans();
	}

	/**
	 * Shows the formatted created_at time
	 *
	 * @return string
	 */
	public function timeFormatted()
	{
		return $this->entity->created_at->format('g:ia F jS, Y');
	}

}