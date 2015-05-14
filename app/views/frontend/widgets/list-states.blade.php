@extends('frontend.widgets.template.master')

@section('widget_title')
	{{ $widget->title or 'Search by State' }}
@overwrite

@section('widget_body')
	<ul class="list-unstyled">
		@foreach(State::cacheTags('projects')->remember(Config::get('acme.cache.project'))->orderBy('state', 'ASC')->get() as $allState)
			<li class="m-b-xs">
				<a href="{{ $allState->present()->url }}" title="{{ $allState->state }}">
					<i class="fa fa-angle-right"></i> <small>{{ $allState->state }}</small>
				</a>
			</li>
		@endforeach
	</ul>
@overwrite