@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	Server Error: 403 (Forbidden)
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<section class="panel b-a">
		<div class="panel-heading b-b">
			<a class="font-bold text-muted" href="#">Access Forbidden</a>
		</div>
		<div class="panel-body">
			<h4>What does this mean?</h4>
			<p>You don't have the necessary permissions to access to this page.</p>
			<hr>
			<a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a></p>
		</div>
	</section>
@stop