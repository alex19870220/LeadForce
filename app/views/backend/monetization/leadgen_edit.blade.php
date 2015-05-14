@extends('partials.modal')

{{-- Modal Title --}}
@section('title')
	Edit Leadgen Form
@stop

{{-- Form Action --}}
@section('form_action')
{{ route('edit/leadgen-form', $leadgenForm->id) }}
@stop

{{-- Form Submit --}}
@section('form_submit')
	Update Leadgen Form
@stop

{{-- Modal Body --}}
@section('body')
	@include('backend.monetization.forms.leadgen', ['form' => $leadgenForm])
@stop