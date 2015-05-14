@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Create Page
@stop

{{-- Accessory Buttons --}}
@section('buttons')
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