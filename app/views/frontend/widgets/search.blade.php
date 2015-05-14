@extends('frontend.widgets.template.master')

@section('widget_title')
@overwrite

@section('widget_body')
	<form role="search" method="GET" id="searchform" class="searchform" action="{{ route('search/location', [$project->slug, $project->tld]) }}">
		<div>
			<label class="sr-only" for="s">Search for:</label>
			<div class="input-group">
				<input type="text" class="form-control" name="q" placeholder="Search">
				<span class="input-group-btn">
					{{-- Form::token() --}}
					<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>
	</form>
@overwrite