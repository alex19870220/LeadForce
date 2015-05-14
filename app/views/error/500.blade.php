@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	Server Error: 500 (Internal Server Error)
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<section class="panel b-a">
		<div class="panel-heading b-b">
			<?php $messages = array('Ouch.', 'Oh no!', 'Whoops!'); ?>
			<a class="font-bold text-muted" href="#"><?php echo $messages[mt_rand(0, 2)]; ?></a>
		</div>
		<div class="panel-body">
			<h4>What does this mean?</h4>
			<p>Something went wrong on our servers while we were processing your request.
				We're really sorry about this, and will work hard to get this resolved as
				soon as possible.</p>
			<hr>
			<a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a></p>
		</div>
	</section>
@stop