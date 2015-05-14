@extends('backend.template.master')

{{-- Page title --}}
@section('title')
{{ Input::old('title', $page->title) }}
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/page') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Create Page</a>
	<a href="{{ route('pages') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
@stop

{{-- Page content --}}
@section('content')
	@include('backend.pages.forms.master')
@stop

{{-- Sub navigation --}}
@section('subnavigation')
	@include('backend.pages.subnav')
@stop