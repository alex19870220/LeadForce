@extends('frontend.templates.default.master')

{{-- Page title --}}
@section('title')
	{{ $niche->present()->pageTitle }}
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	{{ $niche->present()->content }}
@stop