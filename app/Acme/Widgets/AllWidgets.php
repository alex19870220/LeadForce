<?php namspace Acme\Widgets;

use SidebarWidget;
use Widget;

class AllWidgets {

	public function registerWidgets()
	{
		$widgets = SidebarWidget::all();

		foreach($widgets as $widget)
		{
			Widget::register($widget->slug, function($contents)
			{
				return "{$contents}";
			});
		}
	}
}