@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Your Dashboard
@stop

@section('content')
	<section class="panel panel-default">
		<header class="panel-heading font-bold">Indexer API's</header>
		<div class="panel-body">
			<form class="form-horizontal" action="{{ route('account/settings/update-indexer-apis') }}" method="post" autocomplete="off">
				<!-- CSRF Token -->
				{{ Form::token() }}

				@if(! empty(Config::get('acme.api.indexers')))
					@foreach(Config::get('acme.api.indexers') as $indexer => $indexerData)
						<div class="form-group{{ $errors->first($indexer, ' has-error') }}">
							<label class="col-md-3 control-label" for="{{ $indexer }}"><a href="{{ $indexerData['website'] or '#' }}" target="_blank">{{ $indexerData['name'] or 'No Name' }}</a></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="{{ $indexer }}" value="{{ $currentUser->getOption('indexers.' . $indexer . '.apikey') }}" />
								{{ $errors->first($indexer, '<span class="help-block">:message</span>') }}
							</div>
						</div>
					@endforeach
				@endif

				<hr>

				<!-- Form actions -->
				<div class="form-group">
					<div class="col-md-9 col-md-offset-3">
						<button type="submit" class="btn btn-primary">Update Indexer API's</button>
					</div>
				</div>
			</form>
		</div>
	</section>
@stop

{{-- Sub navigation --}}
@section('subnavigation')
	@include('backend.account.template.subnav')
@stop