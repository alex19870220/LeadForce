@extends('frontend.templates.default.master')

{{-- Page title --}}
@section('title')
	{{ $state->state }} {{ $niche->keyword_main }}
	| "{{ Route::input('cityLetter') }}" Cities
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<div class="row">
		<div class="col-md-12 text-center">
			<h2 class="m-t-none">Select Your City by Letter</h2>
		</div>
	</div>
	@include('frontend.pages.geolocations.partials.cities-by-letter', ['cityLetters' => $cityLetters])
	<div class="row">
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