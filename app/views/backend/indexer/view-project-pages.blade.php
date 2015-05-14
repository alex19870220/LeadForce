@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Indexer Dashboard
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a class="btn btn-info" href="{{ route('indexer') }}"><i class="fa fa-share"></i> Return to Indexer Campaigns</a>
@stop

{{-- Page content --}}
@section('content')

@stop