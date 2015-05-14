<div class="input-group-btn block">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> Actions <span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><a href="{{ route('niche/clear-cache', $niche->id) }}" data-confirm><i class="fa fa-fw fa-cubes"></i> Clear Cache</a></li>
		<li class="divider"></li>
		<li><a href="{{ route('delete/niche', $niche->id) }}" data-confirm><i class="glyphicon fa-fw glyphicon-remove-circle"></i> Delete</a></li>
	</ul>
</div>