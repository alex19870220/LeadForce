<div class="input-group-btn">
	<button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-cogs"></i> Actions
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li><a href="{{ route('widgets/edit', $widget->id) }}" data-toggle="ajaxModal"><i class="fa fa-pencil"></i> Edit</a></li>
		@if($widget->type !== 'hardcoded')
			<li><a href="#"><i class="fa fa-copy"></i> Duplicate</a></li>
			<li class="divider"></li>
			<li><a href="{{ route('widgets/delete', $widget->id) }}" data-confirm><i class="glyphicon glyphicon-remove-circle"></i> Delete</a></li>
		@endif
	</ul>
</div>