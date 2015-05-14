@extends('backend.template.master')

{{-- Web site Title --}}
@section('title')
Edit User Group {{ Input::old('name', $group->name) }}
@parent
@stop

{{-- Content --}}
@section('content')
	<section class="panel panel-default" style="overflow: visible;">
		<header class="panel-heading font-bold">
			Update User Group
		</header>
		<div class="panel-body">
			@include('backend.groups.forms.master')
		</div>
	</section>
@stop
