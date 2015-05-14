<tr>
	<td colspan="5" style="padding: 0;border: 0;">
		<div class="panel-collapse collapse" id="project-{{ $project->id }}" role="tabpanel" aria-labelledby="project-{{ $project->id }}-remote">

			<!-- The Niches -->
			@if($project->niche)
				<table class="table table-condensed table-striped table-hover b-a b-primary lter m-b-none" id="projectsTable">
					<thead>
						@include('backend.niches.partials.niche_header')
					</thead>
					<tbody>
						@include('backend.niches.partials.niche_row', ['niche' => $project->niche])
						@foreach($project->niche->children as $child)
							@include('backend.niches.partials.niche_row', ['niche' => $child])
						@endforeach
					</tbody>
				</table>
			@endif

			<!-- Niche Controls -->
			<div class="block clear padder-v">
				<div class="col-md-12">
					<a href="{{ route('create/niche', ['parent' => $project->niche->id]) }}" class="btn btn-default"><i class="fa fa-plus fa-fw text-success"></i> Add Child Niche</a>
				</div>
			</div>

		</div>
	</td>
</tr>