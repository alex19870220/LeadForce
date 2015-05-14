@extends('frontend.templates.default.master')

{{-- Page title --}}
@section('title')
	{{ $state->present()->pageTitle }}
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content_wrapped')
	<div class="row">
		<div class="col-md-12 m-b">
			{{ $state->present()->content }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<h2 class="m-t-none">Select Your City by Letter</h2>
		</div>
	</div>
	@include('frontend.pages.geolocations.partials.cities-by-letter', ['cityLetters' => $cityLetters])
	<div class="row">
		<div class="col-md-12 text-center m-b-lg">
			<h2 class="m-t-none">Top Cities in {{ $state->state }}</h2>
		</div>
		@foreach($cities as $city)
			<div class="col-sm-6 col-md-3 m-b">
				<ul class="m-b-none">
					<li>
						<a href="{{ $city->present()->url }}" class="block">
							{{ $city->city }}, {{ $state->present()->abbr }}
						</a>
					</li>
				</ul>
			</div>
		@endforeach
	</div>
@stop