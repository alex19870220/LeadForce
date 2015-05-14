<?php namespace Acme\Presenters;

use Laracasts\Presenter\Presenter;

class SidebarPresenter extends Presenter {

	public function widgetList()
	{
		return $this->entity->widgets()->get();
	}
}