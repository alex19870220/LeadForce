<section class="panel panel-default" style="overflow: visible;">
	<header class="panel-heading font-bold">
		All Sidebars
	</header>
	<div class="table-responsive">
		<table class="table table-striped b-light">
			<thead>
				<tr>
					<th class="col-md-3">Name</th>
					<th class="col-md-7">Widgets</th>
					<th class="col-md-2">Actions</th>
				</tr>
			</thead>
			<tbody class="l-h-2x">
			@if($listSidebars)
				@foreach($listSidebars as $listSidebar)
					<tr>
						<td><h5>{{ $listSidebar->label }}</h5></td>
						<td>
							@foreach($listSidebar->widgets as $subWidget)
								<span class="label label-default">{{ $subWidget->label }}</span>
							@endforeach
						</td>
						<td>
							<div class="input-group-btn">
								<button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-cogs"></i> Actions
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="{{ route('sidebars/edit', $listSidebar->id) }}"><i class="fa fa-pencil"></i> Edit</a></li>
									<li><a href="#"><i class="fa fa-copy"></i> Duplicate</a></li>
									<li class="divider"></li>
									<li><a href="{{ route('sidebars/delete', $listSidebar->id) }}" data-confirm><i class="glyphicon glyphicon-remove-circle"></i> Delete</a></li>
								</ul>
							</div>
						</td>
					</tr>
				@endforeach
			@endif
			</tbody>
		</table>
	</div>
</section>