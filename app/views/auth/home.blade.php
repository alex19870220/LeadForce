@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	@if(! Sentry::check())
		Please Login or Register
	@else
		Welcome, {{ $currentUser->first_name }}
	@endif
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	@if(! Sentry::check())
		<a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-block">Log In</a>
		<div class="line line-dashed"></div>
		<p class="text-muted text-center"><small>Do not have an account?</small></p>
		<a href="#" class="btn btn-lg btn-default btn-block disabled" disabled>Create an Account</a>
	@else
		<a href="{{ route('dashboard') }}" class="btn btn-lg btn-primary btn-block">Go To {{ Config::get('app.appname') }} Admin</a>
	@endif
@stop