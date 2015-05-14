@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Edit Sidebar {{ $sidebar->label }}
@stop

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-8">
		@include('backend.appearance.partials.sidebars_list')
	</div>
	<div class="col-md-4">
		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold">
				Edit Sidebar
			</header>
			<!-- Add Widgets to Sidebar -->
			<div class="panel-body">
				@include('backend.appearance.forms.sidebar')
			</div>
		</div>
	</div>
</div>
@stop