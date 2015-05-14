@extends('backend.template.subpage')

@section('submenu_content')
	<!-- Tab Content -->
	<div class="tab-content">

		<!-- Tab Pane - Page -->
		<div class="tab-pane fade in active" id="page">
			@include('backend.pages.forms.page')
		</div>

		<!-- Tab Pane - Sidebar Options -->
		<div class="tab-pane fade" id="sidebar">
			@include('backend.pages.forms.sidebar')
		</div>

		<!-- Tab Pane - Options -->
		<div class="tab-pane fade" id="options">
			@include('backend.pages.forms.options')
		</div>

	</div>
@stop

@section('submenu_right')
	<!-- Save -->
	@include('backend.template.forms.submit')

	<!-- Page Active -->
	<section class="panel panel-primary">
		<header class="panel-heading">
			Page Active
		</header>
		<div class="panel-body">
			<!-- Page Active -->
			<div class="form-group" {{ $errors->has('active') ? 'has-error' : '' }}">
				<label class="switch">
					{{ Form::checkbox('active', '1', Input::old('active', $page->active)) }}<span></span>
				</label>
			</div>
		</div>
	</section>

	<!-- Parent Project -->
	<section class="panel panel-primary">
		<header class="panel-heading">
			Parent Project
		</header>
		<div class="panel-body">
			<div class="form-group {{ $errors->has('project_id') ? 'has-error' : '' }}">
				<label for="project_id" class="sr-only">Parent Project</label>
				{{ Form::select('project_id', $projects->lists('label', 'id'), Input::old('projectId'), ['class' => 'form-control']) }}
				{{ $errors->first('project_id', '<span class="help-block">:message</span>') }}
			</div>
		</div>
	</section>

	<section class="panel panel-primary">
		<header class="panel-heading">
			Display Options
		</header>
		<div class="panel-body">
			<!-- Menu Label -->
			<div class="form-group {{ $errors->has('menu_label') ? 'has-error' : '' }}">
				<label for="menu_label">Menu Label</label>
				<input class="form-control" type="text" name="menu_label" id="menu_label" value="{{ Input::old('menu_label', $page->menu_label) }}"/>
				{{ $errors->first('menu_label', '<span class="help-block">:message</span>') }}
			</div>

			<!-- Page Order -->
			<div class="form-group {{ $errors->has('page_order') ? 'has-error' : '' }}">
				<label for="page_order">Page Order</label>
				<input class="form-control" type="number" name="page_order" id="page_order" value="{{ Input::old('page_order', $page->page_order) }}" />
				{{ $errors->first('page_order', '<span class="help-block">:message</span>') }}
			</div>

			<!-- Page Layout -->
			<div class="form-group {{ $errors->has('layout') ? 'has-error' : '' }}">
				<label for="layout">Page Layout</label>
				{{ Form::select('layout', ['content_sidebar' => 'Default (sidebar)', 'content_wrapped' => 'No Sidebar', 'content_full' => 'Full Width'], $page->layout, ['class' => 'form-control']) }}
				{{ $errors->first('layout', '<span class="help-block">:message</span>') }}
			</div>

			<!-- Icon -->
			<div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
				<label for="icon">Icon (<a href="http://flatfull.com/themes/note/icons.html" target="_blank">view icons</a>)</label>
				<input class="form-control" type="text" name="icon" id="icon" value="{{ Input::old('icon', $page->icon) }}"/>
				{{ $errors->first('icon', '<span class="help-block">:message</span>') }}
			</div>
		</div>
	</section>
@stop