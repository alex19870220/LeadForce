@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Create Project
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('projects') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
@stop

{{-- Page content --}}
@section('content')
	@include('backend.projects.forms.master')
@stop

{{-- Sub navigation --}}
@section('subnavigation')
	@include('backend.projects.subnav')
@stop