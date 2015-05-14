@extends('partials.modal')

{{-- Modal Title --}}
@section('title')
	Edit Email Optin
@stop

{{-- Form Action --}}
@section('form_action')
{{ route('edit/email-optin', $emailOptinForm->id) }}
@stop

{{-- Form Submit --}}
@section('form_submit')
	Update Email Optin
@stop

{{-- Modal Body --}}
@section('body')
	@include('backend.monetization.forms.emailoptin', ['form' => $emailOptinForm])
@stop