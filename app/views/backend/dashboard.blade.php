@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Welcome to {{ Config::get('app.appname') }}, {{ $currentUser->first_name }}!
@stop

{{-- Page content --}}
@section('content')
	//
@stop