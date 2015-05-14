@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Bulk Project Updates
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('bulk/project-updater/process') }}" class="btn btn-info">
		<i class="fa fa-plus"></i> Update Niche Stats
	</a>
@stop

{{-- Page content --}}
@section('content')
	<h2 class="page-header">cPanel Testing</h2>
	{{-- dd(json_decode(Cpanel::listaccts(), true)) --}}
@stop