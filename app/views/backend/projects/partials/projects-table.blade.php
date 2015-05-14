<table class="table table-condensed table-hover b-b" style="overflow: visible;">
	<thead>
		<tr>
			<th class="col-md-3">Niche + Project</th>
			<th class="col-md-2">Category</th>
			<th class="col-md-5 hidden-sm">
				<div class="row no-gutter text-center">
					@include('backend.projects.partials.table-partials.statuschecks-header')
				</div>
			</th>
			<th class="col-md-1 hidden-sm text-center">Visits</th>
			<th class="col-md-1"></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($projects as $project)
			@include('backend.projects.partials.project-row', ['project' => $project])
		@endforeach
	</tbody>
</table>