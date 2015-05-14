@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	HomeAdvisor Leadgen URL's
@stop

{{-- Page content --}}
@section('content')
	<div class="row">
		<div class="col-md-6">
			<section class="panel panel-default" style="overflow: visible;">
				<header class="panel-heading font-bold">
					Your HomeAdvisor URL's
				</header>
				<div class="table-responsive">
					<table class="table table-striped b-t b-light">
						<thead class="l-h-2x">
							<tr>
								<th>ID</th>
								<th>User ID</th>
								<th>Type</th>
								<th>Num. URL's</th>
							</tr>
						</thead>
						<tbody class="l-h-2x">
							@foreach($homeAdvisorUrls as $homeAdvisorUrlsSet)
								<tr>
									<td>{{ $homeAdvisorUrlsSet->id }}</td>
									<td>{{ $homeAdvisorUrlsSet->user_id }}</td>
									<td>{{ $urlTypes[$homeAdvisorUrlsSet->url_type] or 'type unknown' }}</td>
									<td>{{ number_format(count(json_decode($homeAdvisorUrlsSet->urls, true))) }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</section>
		</div>
		<div class="col-md-6">
			<section class="panel panel-default" style="overflow: visible;">
				<header class="panel-heading font-bold">
					Upload HomeAdvisor URL's
				</header>
				<div class="panel-body">
					<div class="alert alert-info">
						<p><i class="fa fa-exclamation-circle"></i> Make sure you convert your .xlsx spreadsheet(s) to .csv before uploading!</p>
					</div>

					<form class="form-horizontal" method="POST" action="{{ route('homeadvisor/add-urls') }}" autocomplete="off" enctype="multipart/form-data">
						<!-- Spreadsheet -->
						<div class="form-group{{ $errors->has('spreadsheet') ? ' has-error' : '' }}">
							<label class="control-label col-md-4" for="spreadsheet">Spreadsheet</label>
							<div class="col-md-8">
								<input type="file" class="filestyle" name="spreadsheet" data-iconName="fa fa-file-excel-o">
								{{ $errors->first('spreadsheet', '<span class="help-block">:message</span>') }}
							</div>
						</div>

						<!-- Type of URL's -->
						<div class="form-group{{ $errors->has('url_type') ? ' has-error' : '' }}">
							<label class="control-label col-md-4" for="url_type">Type of URL's</label>
							<div class="col-md-8">
								<select class="selectpicker" name="url_type">
									<option>Select</option>
									@foreach($urlTypes as $urlType => $urlTypeLabel)
										<option value="{{ $urlType }}">{{ $urlTypeLabel }}</option>
									@endforeach
								</select>
								{{ $errors->first('url_type', '<span class="help-block">:message</span>') }}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-offset-4 col-md-8">
								<!-- CSRF Token -->
								{{ Form::token() }}
								<button type="submit" class="btn btn-primary">Upload Spreadsheet</button>
							</div>
						</div>
					</form>

				</div>
			</section>
		</div>
	</div>
@stop