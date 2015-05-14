@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Create Niche
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('niches') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
@stop

{{-- Page content --}}
@section('content')
	@include('backend.niches.forms.master')
@stop

{{-- Sub navigation --}}
@section('subnavigation')
	@include('backend.niches.subnav')
@stop