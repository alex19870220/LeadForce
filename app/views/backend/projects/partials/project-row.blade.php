@if($project->hasErrors())
<tr class="danger">
@else
<tr>
@endif
	<!-- Project Label / Website URL / Niche Dropdown -->
	<td class="pos-rlt">
		<!-- Niche Dropdown -->
		@if($project->niche)
			<button type="button" class="btn btn-default project-niche-button m-r" data-toggle="collapse" data-target="#project-{{ $project->id }}" aria-expanded="false" aria-controls="project-{{ $project->id }}"></button>
		@else
			<a href="{{ route('create/niche') }}" class="btn btn-default project-niche-button project-niche-button-plus m-r" {{ tooltip('Create Niche') }}></a>
		@endif

		<!-- Project Label & URL -->
		<div class="m-l-xl m-t-xs">
			<span class="pull-left text-md">
				<a href="{{ route('edit/project', $project->id) }}" class="text-ellipsis">
					{{ $project->website_title }}
				</a>
			</span>

			<!-- Website/Sitemap/VideoSitemap -->
			<div class="pull-right">
				@if(! $project->present()->checkStatusIcon())
					<a href="#" class="btn btn-default btn-xs">
						<i class="fa fa-exclamation-triangle text-danger" {{ tooltip('Incomplete or Errors!') }}></i>
					</a>
				@endif
				<a href="#" class="btn btn-link btn-xs pos-rlt" {{ tooltip("{$project->present()->nicheCount} Niches") }}>
					<span class="badge bg-light">{{ $project->present()->nicheCount }}</span>
				</a>
				<a href="#" class="btn btn-default btn-xs dropdown-toggle pos-rlt" data-toggle="dropdown">
					<i class="fa fa-external-link"></i>
				</a>
				@include('backend.projects.partials.table-partials.project-links')
			</div>
		</div>
	</td>

	<!-- Category -->
	<td>
		<div class="m-t-xs">
			{{ $project->category->label or '' }}
		</div>
	</td>

	<!-- Status Checks -->
	<td class="hidden-sm">
		<div class="row no-gutter">
			@include('backend.projects.partials.table-partials.statuschecks')
		</div>
	</td>

	<!-- Visitor Stats -->
	<td class="bg-light">
		<div class="text-center">
			<span class="text-lg block">
				@if(! is_null($project->tracking_id))
				<span data-piwik-stats data-url="{{ route('ajax/piwik-stats', $project->tracking_id) }}" data-segment="visits"></span>
				@else
				{{ Config::get('acme.display.empty.number') }}
				@endif
			</span>
		</div>
	</td>

	<!-- Actions -->
	<td>
		@include('backend.projects.partials.actions', ['project' => $project])
	</td>
</tr>
<!-- Project's Niches -->
@if($project->niche)
	@include('backend.projects.partials.table-partials.project-niches')
@endif