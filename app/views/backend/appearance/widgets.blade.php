@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Widgets
@stop

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-8">
		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold">
				Custom Widgets
			</header>
			<div class="table-responsive">
				<table class="table table-striped b-light">
					<thead class="l-h-2x">
						<tr>
							<th class="col-md-3">Label</th>
							<th class="col-md-4">Title</th>
							<th class="col-md-3">Type</th>
							<th class="col-md-2">Actions</th>
						</tr>
					</thead>
					<tbody class="l-h-2x">
					@if($monetizationWidgets)
						@foreach($monetizationWidgets as $widget)
							@include('backend.appearance.partials.widget_table')
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</section>

		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold">
				Hardcoded Widgets <span class="text-muted">(You can't delete these)</span>
			</header>
			<div class="table-responsive">
				<table class="table table-striped b-light">
					<thead class="l-h-2x">
						<tr>
							<th class="col-md-3">Label</th>
							<th class="col-md-4">Title</th>
							<th class="col-md-3">Type</th>
							<th class="col-md-2">Actions</th>
						</tr>
					</thead>
					<tbody class="l-h-2x">
					@if($hardcodedWidgets)
						@foreach($hardcodedWidgets as $widget)
							@include('backend.appearance.partials.widget_table')
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</section>
	</div>
	<div class="col-md-4">
		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold">
				Create New Widget
			</header>
			<div class="panel-body">
				<form method="POST" action="{{ route('widgets/create') }}">
					@include('backend.appearance.forms.widget', ['widget' => $newWidget])

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Create</button>
					</div>
				</form>
			</div>
		</section>
	</div>
</div>
@stop