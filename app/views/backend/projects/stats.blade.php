@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Project Statistics
@stop

{{-- Page content --}}
@section('content')
	<div class="row">
		<div class="col-md-6">
			<span id="stats"></span>
		</div>
	</div>
	<script>
	$(document).ready(function() {
		$("#stats").sparkline([{{ implode($stats, ',') }}], {
		type: 'line',
		width: '100%',
		lineColor: '#00bf00',
		fillColor: '#e1e6f2'});
	});
	</script>
@stop