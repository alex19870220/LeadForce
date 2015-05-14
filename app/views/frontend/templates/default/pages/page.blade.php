@extends('frontend.templates.default.master')

{{-- Page title --}}
@section('title')
	{{ $page->title }}
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	{{ $page->content }}
@stop