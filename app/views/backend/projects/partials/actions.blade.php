<div class="btn-group">
	<button type="button" class="btn btn-default btn-sm block dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-cogs"></i> Actions <span class="caret"></span>
	</button>
	<ul class="dropdown-menu dropdown-menu-right">
		<li><a href="{{ route('project/calculate-niche-stats', $project->id) }}" data-confirm><i class="fa fa-fw fa-refresh"></i> Calc. Niche Stats</a></li>
		<li><a href="{{ route('project/clear-errors', $project->id) }}" data-confirm><i class="fa fa-fw fa-exclamation-circle"></i> Clear Errors</a></li>
		<li class="divider"></li>
		<li><a href="{{ route('project/clear-cache', $project->id) }}" data-confirm><i class="fa fa-fw fa-cubes"></i> Clear Cache</a></li>
		<li class="divider"></li>
		<li><a href="{{ route('delete/project', $project->id) }}" data-confirm><i class="glyphicon fa-fw glyphicon-remove-circle"></i> Delete</a></li>
	</ul>
</div>