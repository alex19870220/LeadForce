@extends('partials.modal')

@section('title')
	Indexer Service Push
@stop

@section('body')

			<!-- Project -->
			<div class="form-group">
				<label class="col-md-3 control-label" for="indexer_service">Project</label>
				<div class="col-md-9">
					<input type="text" class="form-control" value="{{ $project->label }}" disabled>
				</div>
			</div>

			<!-- Indexer Service -->
			<div class="form-group">
				<label class="col-md-3 control-label" for="indexer_service">Indexer Service</label>
				<div class="col-md-9">
					<select class="form-control" name="indexer_service">
						@foreach(Config::get('acme.api.indexers') as $indexer => $indexerData)
							@if(isset($userIndexerServices->{$indexer}->apikey) && ! empty($userIndexerServices->{$indexer}->apikey))
							<option value="{{ $indexer }}">{{ $indexerData['name'] or 'No Name' }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>

			<!-- URL's to Submit -->
			<div class="form-group">
				<label class="col-md-3 control-label" for="urls_to_submit">Submit URL's</label>
				<div class="col-md-9">
					<div class="checkbox i-checks">
						<label>
							<input type="checkbox" name="urls_to_submit[]" value="states">
							<i></i> States
						</label>
					</div>
					<div class="checkbox i-checks disabled">
						<label>
							<input type="checkbox" name="urls_to_submit[]" value="cities" disabled>
							<i></i> Cities
						</label>
					</div>
					<div class="checkbox i-checks disabled">
						<label>
							<input type="checkbox" name="urls_to_submit[]" value="niches" disabled>
							<i></i> Niches
						</label>
					</div>
					<div class="checkbox i-checks disabled">
						<label>
							<input type="checkbox" name="urls_to_submit[]" value="pages" disabled>
							<i></i> Pages
						</label>
					</div>
				</div>

@stop

@section('form_class') form-horizontal @stop
@section('form_action') {{ route('indexer/post-indexer-services', $project->id) }} @stop
@section('form_submit') Submit to Indexers @stop