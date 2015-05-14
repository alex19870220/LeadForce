@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Indexer Dashboard
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal">
		<i class="fa fa-plus"></i> Create Campaign
	</button>
@stop

{{-- Page content --}}
@section('content')
<section class="panel panel-default" style="overflow: visible;">
	<header class="panel-heading font-bold">
		Current Indexing Campaigns
	</header>
	<div class="row wrapper">
		<div class="col-md-6">
			@if(! Input::get('onlyActive') && ! Input::get('onlyFinished'))
				<a class="btn btn-success btn-sm disabled" href="{{ route('indexer') }}">All Campaigns</a>
			@else
				<a class="btn btn-default btn-sm" href="{{ route('indexer') }}">All Campaigns</a>
			@endif

			@if(Input::get('onlyActive'))
				<a class="btn btn-success btn-sm disabled" href="{{ URL::to('admin/indexer?onlyActive=true') }}">Active Campaigns</a>
			@else
				<a class="btn btn-default btn-sm" href="{{ URL::to('admin/indexer?onlyActive=true') }}">Active Campaigns</a>
			@endif

			@if(Input::get('onlyFinished'))
				<a class="btn btn-success btn-sm disabled" href="{{ URL::to('admin/indexer?onlyFinished=true') }}">Inactive/Finished Campaigns</a>
			@else
				<a class="btn btn-default btn-sm" href="{{ URL::to('admin/indexer?onlyFinished=true') }}">Inactive/Finished Campaigns</a>
			@endif
		</div>
		<div class="col-md-6">
			<a class="btn btn-default pull-right" href="{{ route('indexer/update-index-count') }}"><i class="fa fa-refresh"></i> Check Indexed Pages</a>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover b-t b-light">
			<thead>
				<tr>
					<th class="col-md-3">Project</th>
					<th class="col-md-1">Index Rate</th>
					<th class="col-md-7">
						@include('backend.indexer.table-partials.stats-header')
					</th>
					<th class="col-md-1">Actions</th>
				</tr>
			</thead>

			<tbody class="">
				@foreach($campaigns as $campaign)
				<tr>
					<td>
						<div class="block">
							<a href="{{ route('edit/project', $campaign->project->id) }}" class="text-md m-t-sm">
								{{ $campaign->project->website_url or '' }}
							</a>
							<div class="pull-right">
								<span class="m-l-sm">
									{{ $campaign->present()->indexPercent() }}%
								</span>
								</a>
							</div>
						</div>
						{{ $campaign->present()->progressBar() }}
					</td>
					<td>
						<div class="clear" style="width:110px;">
							<span class="sparkline" data-type="line" data-width="110px" data-height="35px">
								{{ implode(array_reverse($campaign->project->stats->take(14)->lists('index_count')), ',') }}
							</span>
						</div>
					</td>
					<td class="hidden-xs hidden-sm">
						@include('backend.indexer.table-partials.stats')
					</td>
					<td>
						@if($campaign->project->niche !== null)
							@include('backend.indexer.partials.actions', compact('campaign'))
						@else
							<span class="block text-center text-muted m-t-sm">No Niche!</span>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
	</div>
</section>
@stop

{{-- Modal Title and Button Text --}}
@section('modal-title')
	Start a New Indexer Campaign
@stop
@section('modal-button')
	Create Campaign
@stop

{{-- Modal Content (in a form) --}}
@section('modal')
	<div class="form-group">
		<label class="col-sm-3 control-label" for="project_id">Project</label>
		<div class="col-md-9">
			{{ Form::select('project_id', $projects->lists('website_title', 'id'), null, ['class' => 'form-control']) }}
		</div>
	</div>
	<!-- CSRF Token -->
	{{ Form::token() }}
@stop