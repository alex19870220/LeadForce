@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Niche: {{ Input::old('label', $niche->label) }}
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	@if(! is_null($niche->parent_id))
	<a href="{{ $niche->present()->highlightUrl($niche->parent_id) }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
	@else
	<a href="{{ $niche->present()->highlightUrl($niche->id) }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
	@endif
@stop

{{-- Page content --}}
@section('content')
	@include('backend.niches.forms.master')
@stop

{{-- Sub navigation --}}
@section('subnavigation')
	@include('backend.niches.subnav')
@stop