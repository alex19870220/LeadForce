@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Geolocation Dashboard
@stop

{{-- Accessory Buttons --}}
@section('buttons')

@stop

{{-- Page content --}}
@section('content')
	<div class="row">

		<!-- Statistics -->
		<div class="col-md-6">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">
					United States Statistics
				</header>
				<table class="table table-striped b-light">
					<thead>
						<tr>
							<th class="col-md-4">State</th>
							<th class="col-md-2">Abbr</th>
							<th class="col-md-3">Counties</th>
							<th class="col-md-3">Cities</th>
						</tr>
					</thead>
					<tbody>
						@foreach($geoStates as $geoState)
						<tr>
							<td>{{ $geoState->state }}</td>
							<td>{{ $geoState->present()->abbr }}</td>
							<td>{{ number_format($geoState->counties->first()->county_count) }}</td>
							<td>
								@if($geoState->cities->count() > 0)
									{{ number_format($geoState->cities->first()->city_count) }}
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>

					</tfoot>
				</table>
			</section>
		</div>

		<!-- Countries -->
		<div class="col-md-6">
			<section class="panel panel-primary">
				<header class="panel-heading font-bold">
					Import Database
				</header>
				<section class="panel-body">
					<div class="alert alert-danger">
						<p>Hey! It looks like the GeoLocation Database isn't imported yet. You <strong>must</strong> do this before {{ Config::get('app.appname') }} will work!</p>
					</div>
					<form class="form-inline" method="post" action="{{ route('geolocation/import-geolocation-db') }}" autocomplete="off" enctype="multipart/form-data">
						<!-- CSRF Token -->
						{{ Form::token() }}
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Import GeoLocation Database</button>
						</div>
					</form>
				</section>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading font-bold">
					Geolocation Actions
				</header>
				<div class="panel-body form-horizontal">
					<form action="{{ route('geolocation-city-letters') }}" method="POST">
						<h4 class="page-header m-t-none">Update City First Letter Index</h4>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
							<p>This is for the 'Directory' portion of the website. It indexes the first letter of each citys' name, for easier navigation.</p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<!-- CSRF Token -->
								{{ Form::token() }}
								<button type="submit" class="btn btn-primary">Index City First Letters</button>
							</div>
						</div>
					</form>

					<form action="{{ route('geolocation-city-population') }}" method="POST" enctype="multipart/form-data">
						<h4 class="page-header">Update City Populations</h4>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<p>This updates City populations with whatever data you upload. This is used for a variety of things such as top 50/100 lists of cities.</p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">CSV File</label>
							<div class="col-md-8">
								<input type="file" class="filestyle" name="csv" data-icon="fa fa-file-excel-o" data-classButton="btn btn-default" data-classInput="form-control inline input-s">
								<!-- CSRF Token -->
								{{ Form::token() }}
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Update Population</button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>

@stop