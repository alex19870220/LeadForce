@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Projects Dashboard
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/niche') }}" class="btn btn-default">
		<i class="fa fa-fw fa-plus text-success"></i> Create Niche
	</a>
	<a href="{{ route('create/project') }}" class="btn btn-default m-l-sm">
		<i class="fa fa-plus"></i> Create Project
	</a>
	<div class="btn-group m-l-sm">
		<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-cogs"></i> Project Actions <span class="caret"></span>
		</button>
		<ul class="dropdown-menu dropdown-menu-right">
			<li>
				<a href="{{ route('project/create-piwik-sites') }}" data-confirm>
					<i class="fa fa-bar-chart-o"></i> Update Piwik Sites
				</a>
			</li>
		</ul>
	</div>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-8">
		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold b-b-none">
				Project Category &amp; Display Filters
			</header>
			<div class="panel-body">
				<form class="form-inline" method="POST" action="{{ route('projects/projects-table') }}" data-ajax-submit data-ajax-output="#projectsTable">
					@include('backend.projects.partials.project-filters')
				</form>
			</div>
		</section>
	</div>
	<div class="col-md-4">
		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold b-b-none">
				Piwik Stats Date Range
			</header>
			<div class="panel-body">
				<form class="form-inline" method="POST" action="{{ route('projects/projects-table') }}" data-ajax-submit data-ajax-output="#projectsTable">
					@include('backend.projects.partials.projects-piwik')
				</form>
			</div>
		</section>
	</div>
</div>

<section class="panel panel-default m-b-lg">
	<header class="panel-heading font-bold b-b-none">
		Projects List
	</header>
	<div class="table-responsive" id="projectsTable" style="overflow: visible;">
		@include('backend.projects.partials.projects-table')
	</div>
</section>
@stop