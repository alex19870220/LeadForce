@extends('frontend.widgets.template.master')

@if(in_array(Route::currentRouteName(), ['project/city', 'project/niche']))
	@section('widget_title')
		{{ $widget->title or 'Popular Services' }}
	@overwrite

	@section('widget_body')
		<ul class="list-unstyled">
			<li class="m-b-xs">
				<a href="{{ $city->present()->url }}" title="{{ $city->city }} {{ $state->present()->abbr }} {{ $project->niche->keyword_main }}">
					<i class="fa fa-angle-right"></i>
					<small>{{ $project->niche->present()->pageTitle }}</small>
				</a>
			</li>
			@foreach($project->niche->children as $child)
				<li class="m-b-xs">
					<a href="{{ $child->present()->url }}" title="{{ $city->city }} {{ $state->present()->abbr }} {{ $child->label }}">
						<i class="fa fa-angle-right"></i>
						<small>{{ $child->present()->pageTitle }}</small>
					</a>
				</li>
			@endforeach
		</ul>
	@overwrite
@else

	@section('widget_title') @overwrite
	@section('widget_body') @overwrite

@endif