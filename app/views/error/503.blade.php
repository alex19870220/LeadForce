@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	Scheduled Maintenance (503)
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<section class="panel b-a">
		<div class="panel-body">
			<h4>What does this mean?</h4>
			<p>We are under a scheduled maintenance and we'll be back shortly!</p>
			<hr>
			<a href="https://www.google.com" class="btn btn-primary">Go Back</a></p>
		</div>
	</section>
@stop