@extends('backend.template.subpage')

@section('submenu_content')
<!-- Tab Content -->
<div class="tab-content form-horizontal">

	<!-- Tab Pane - Content -->
	<div class="tab-pane fade in active" id="nichecontent">
		@include('backend.niches.forms.niche')
	</div>

	<!-- Tab Pane - Sub Services -->
	<div class="tab-pane fade" id="subservices">
		@include('backend.niches.forms.subservices')
	</div>

	<!-- Tab Pane - Meta Info -->
	<div class="tab-pane fade" id="metainfo">
		@include('backend.niches.forms.metainfo')
	</div>

	<!-- Tab Pane - Sidebar -->
	<div class="tab-pane fade" id="sidebar">
		@include('backend.niches.forms.sidebar')
	</div>

</div><!-- End Tab Content -->
@stop

@section('submenu_right')
	<!-- Save -->
	@include('backend.template.forms.submit')
@stop