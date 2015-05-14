<li class="panel-heading bg-primary lter m-b m-t widget-block block" data-id="{{ $widget->id }}">
	<span class="pull-right">
		<!-- Remove Widget -->
		<a href="#" class="widget-remove btn btn-default btn-xs">
			<i class="fa fa-times" data-toggle="tooltip" data-original-title="Remove"></i>
		</a>
	</span>
	<span class="pull-left media-xs">
		<i class="fa fa-sort text-muted fa m-r"></i>
		<span class="widget-order font-bold"></span>
	</span>
	<div class="clear text-white">
		{{ $widget->label }}
	</div>
</li>