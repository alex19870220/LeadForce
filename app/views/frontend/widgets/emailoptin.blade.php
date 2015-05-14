@if($project->getOption('monetization.type') == 'emailoptin')
	@extends('frontend.widgets.template.master')

	@section('widget_title')
		{{ $widget->title }}
	@overwrite

	@section('widget_body')
		@include('frontend.partials.monetizations.emailoptins.emailoptin', ['optinType' => 'widget', 'emailOptin' => OptinForm::find($widget->form_id)])
	@overwrite
@endif