@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Queue Mananger
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="#" class="btn btn-info">
		<i class="fa fa-plus"></i> Flush Queue Failed Jobs
	</a>
@stop

{{-- Page content --}}
@section('content')

@stop