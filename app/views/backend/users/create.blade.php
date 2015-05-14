@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Create a New User
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('users') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
@stop

{{-- Page content --}}
@section('content')
<section class="panel panel-default">
	<header class="panel-heading font-bold">
		Create New User
	</header>
	<div class="panel-body">
		@include('backend.users.forms.master')
	</div>
</section>
@stop