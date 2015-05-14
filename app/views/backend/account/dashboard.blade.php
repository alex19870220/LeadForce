@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Your Dashboard
@stop

@section('content')
	<h3 class="m-t-none">Sup big pimpin. This is your user dashboard!</h3>
@stop

{{-- Sub navigation --}}
@section('subnavigation')
	@include('backend.account.template.subnav')
@stop