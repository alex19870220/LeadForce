@extends('frontend.widgets.template.master')

@section('widget_title')
	{{ $widget->title or 'Top Cities' }}
@overwrite

@section('widget_body')
	<ul class="list-unstyled">
		@foreach(City::cacheTags('projects')->remember(Config::get('acme.cache.project'))->with('state')->orderBy('population', 'DESC')->limit(25)->get() as $popularCity)
			<li class="m-b-xs">
				<a href="{{ $popularCity->present()->url($project->slug, $project->tld, $popularCity->state->abbr) }}" title="{{ $popularCity->city }}">
					<i class="fa fa-angle-right"></i>
					<small>{{ $popularCity->city }}, {{ $popularCity->state->present()->abbr }}</small>
				</a>
			</li>
		@endforeach
	</ul>
@overwrite