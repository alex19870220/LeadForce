@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Project: {{ Input::old('label', $project->label) }}
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/project') }}" class="btn btn-info"><i class="fa fa-plus"></i> Create Project</a>
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