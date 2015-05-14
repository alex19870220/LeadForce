@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Proxy Dashboard
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal">
		<i class="fa fa-plus"></i> Add Proxies
	</button>
@stop

{{-- Page content --}}
@section('content')
	<section class="panel panel-default">
		<header class="panel-heading font-bold">
			Current Proxies
		</header>
		<div class="row wrapper">
			<div class="col-md-6">
				@if(!Input::get('withDead') && !Input::get('onlyDead'))
					<a class="btn btn-success btn-sm disabled" href="{{ route('proxies') }}">Alive Proxies</a>
				@else
					<a class="btn btn-default btn-sm" href="{{ route('proxies') }}">Alive Proxies</a>
				@endif
				@if(Input::get('withDead'))
					<a class="btn btn-success btn-sm disabled" href="{{ URL::to('admin/settings/proxies?withDead=true') }}">Alive + Dead Proxies</a>
				@else
					<a class="btn btn-default btn-sm" href="{{ URL::to('admin/settings/proxies?withDead=true') }}">Alive + Dead Proxies</a>
				@endif
				@if(Input::get('onlyDead'))
					<a class="btn btn-success btn-sm disabled" href="{{ URL::to('admin/settings/proxies?onlyDead=true') }}">Dead Proxies</a>
				@else
					<a class="btn btn-default btn-sm" href="{{ URL::to('admin/settings/proxies?onlyDead=true') }}">Dead Proxies</a>
				@endif
			</div>
			<!-- Delete All Proxies -->
			<div class="col-md-6 text-right form-inline">
				<a href="{{ route('proxies/clear-all') }}" class="btn btn-default btn-sm pull-right m-l-lg" data-confirm>
					<i class="fa fa-eraser"></i> Delete All Proxies
				</a>
				<label class="control-label m-r-sm">{{ $proxies->count() }} total proxies</label>
			</div>
		</div>
		<div class="table-responsive">

			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th class="col-sm-1">ID</th>
						<th class="col-sm-3">IP:Port:User:Pass</th>
						<th class="col-sm-2">Status</th>
						<th class="col-sm-2">Last Used</th>
						<th class="col-sm-2">Last Result</th>
						<th class="col-sm-2">Last Load Time</th>
					</tr>
				</thead>
				<tbody class="l-h-2x">
					@foreach($proxies as $proxy)
					<tr>
						<td>{{ $proxy->id }}</td>
						<td>{{ $proxy->ip }}:{{ $proxy->port }}:{{ $proxy->username }}:{{ $proxy->password }}</td>
						<td>{{ $proxy->present()->proxyStatus }}</td>
						<td>{{ $proxy->last_used->diffForHumans() }}</td>
						<td>{{ $proxy->present()->lastResult }}</td>
						<td><strong>{{ $proxy->present()->lastLoadTime }}</strong> seconds</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</section>
@stop

{{-- Modal Title and Button Text --}}
@section('modal-title')
	Add New Proxies
@stop
@section('modal-button')
	Add Proxies
@stop

{{-- Modal Content (in a form) --}}
@section('modal')
	<div class="form-group">
		<label class="col-sm-3 control-label" for="project_id">Proxies</label>
		<div class="col-md-9">
			<textarea class="form-control col-md-12" rows="10" name="proxies" id="proxies"></textarea>
			<span class="help-block">Proxy format: IP:Port:Username:Password</span>
		</div>
	</div>
	<!-- CSRF Token -->
	{{ Form::token() }}
@stop