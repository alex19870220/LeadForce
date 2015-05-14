@extends('frontend.templates.default.master')

{{-- Page title --}}
@section('title')
	Browse States
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<h2 class="m-t-none">Select Your State</h2>
	<ul class="m-b-none fa-ul">
		@foreach($states as $state)
			<li class="h4 m-b-sm">
				<i class="fa fa-li fa-search text-muted"></i>
				<a href="{{ $state->present()->url() }}" >
					{{ $state->state }}
				</a>
			</li>
		@endforeach
	</ul>
@stop