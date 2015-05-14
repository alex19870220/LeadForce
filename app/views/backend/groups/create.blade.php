@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Create a User Group
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('groups') }}" class="btn btn-sm btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
@stop

{{-- Page content --}}
@section('content')
	<section class="panel panel-default" style="overflow: visible;">
		<header class="panel-heading font-bold">
			New User Group
		</header>
		<div class="panel-body">
			@include('backend.groups.forms.master')
		</div>
	</section>
@stop
