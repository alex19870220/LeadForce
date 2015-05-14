@extends('backend.template.master')

{{-- Page title --}}
@section('title')
{{ Input::old('label', $niche->label) }}
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/niche') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Create Niche</a>
	<a href="{{ route('niches') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
@stop

{{-- Page content --}}
@section('content')
	@include('backend.niches.forms.master')
@stop
