@extends('backend.template.subpage')

@section('submenu_content')
	<!-- Tab Content -->
	<div class="tab-content form-horizontal">

		<!-- Tab Pane - Project -->
		<div class="tab-pane fade in active" id="project-project">
			@include('backend.projects.forms.project')
		</div>

		<!-- Tab Pane - Content -->
		<div class="tab-pane fade" id="project-content">
			@include('backend.projects.forms.content')
		</div>

		<!-- Tab Pane - Lander -->
		<div class="tab-pane fade" id="project-lander">
			@include('backend.projects.forms.lander')
		</div>

		<!-- Tab Pane - Adsense -->
		<div class="tab-pane fade" id="project-adsense">
			@include('backend.projects.forms.adsense')
		</div>

		<!-- Tab Pane - Monetization -->
		<div class="tab-pane fade" id="project-monetization">
			@include('backend.projects.forms.monetization')
		</div>

		<!-- Tab Pane - Design -->
		<div class="tab-pane fade" id="project-design">
			@include('backend.projects.forms.design')
		</div>

		<!-- Tab Pane - Options -->
		<div class="tab-pane fade" id="project-options">
			@include('backend.projects.forms.options')
		</div>

	</div>
@stop

@section('submenu_right')
	<!-- Save -->
	@include('backend.template.forms.submit')

	<!-- Piwik Tracking ID -->
	<section class="panel panel-default b-a">
		<header class="panel-heading b-b font-bold">
			Piwik Tracking ID
		</header>
		<div class="panel-body">
			<div class="form-group">
				<label class="sr-only" for="thumbnail">Tracking ID</label>
				<input class="form-control disabled" type="number" name="tracking_id" id="tracking_id" placeholder="0123" value="{{ Input::old('tracking_id', $project->tracking_id) }}" disabled/>
				<span class="help-block"><i class="fa fa-exclamation-circle text-danger"></i> You shouldn't have to edit this</span>
			</div>
		</div>
	</section>
@stop