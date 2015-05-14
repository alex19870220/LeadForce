@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Spintax Dashboard
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('spintax/recompile-headers') }}" class="btn btn-primary disabled" disabled>
		<i class="fa fa-random"></i> Recompile Header Files
	</a>
@stop

{{-- Page content --}}
@section('content')
	<h3 class="b-m-sm">Current Number of Header Files: {{ count($currentHeaders) }}</h3>
	<h3 class="b-m-sm">Groups start at the number 0</h3>
	<h3>{{ $headersPerFile }} headers per file</h3>
@stop