@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	Server Error: 404 (Not Found)
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<section class="panel b-a">
		<div class="panel-heading b-b">
			<?php $messages = array('We need a map.', 'I think we\'re lost.', 'We took a wrong turn.'); ?>
			<a class="font-bold text-muted" href="#"><?php echo $messages[mt_rand(0, 2)]; ?></a>
		</div>
		<div class="panel-body">
			<h4>What does this mean?</h4>
			<p>We couldn't find the page you requested on our servers. We're really sorry
				about that. It's our fault, not yours. We'll work hard to get this page
				back online as soon as possible.</p>
			<hr>
			<a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a></p>
		</div>
	</section>
@stop