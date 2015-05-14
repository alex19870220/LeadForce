@extends('frontend.widgets.template.master')

@if(in_array(Route::currentRouteName(), ['project/city', 'project/niche']))
	@section('widget_title')
		{{ $widget->title or 'Cities Nearby [city]' }}
	@overwrite

	@section('widget_body')
		<ul class="list-unstyled">
			<li class="m-b-xs">
				<a href="{{ $city->present()->url }}" title="{{ $city->city }} {{ $state->present()->abbr }} {{ $project->niche->keyword_main }}">
					<i class="fa fa-angle-right"></i> <small>{{ $city->city }}, {{ $state->present()->abbr }}</small>
				</a>
			</li>
			@if($city->county->cities)
				@foreach($city->county->cities as $nearbyCity)
					<li class="m-b-xs">
						<a href="{{ $nearbyCity->present()->url }}" title="{{ $nearbyCity->city }} {{ $state->present()->abbr }} {{ $project->niche->keyword_main }}">
							<i class="fa fa-angle-right"></i> <small>{{ $nearbyCity->city }}, {{ $state->present()->abbr }}</small>
						</a>
					</li>
				@endforeach
			@endif
		</ul>
	@overwrite
@else

	@section('widget_title') @overwrite
	@section('widget_body') @overwrite

@endif