@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Project Pages
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/page') }}{{ (null !== Request::getQueryString('projectId')) ? '?'.Request::getQueryString('projectId') : '' }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Create Page</a>
@stop

{{-- Page content --}}
@section('content')
	<div class="row m-b-sm">
		<div class="col-md-8">
			@if(!Input::get('withTrashed') && !Input::get('onlyTrashed'))
				<a class="btn btn-success btn-sm disabled" href="{{ route('pages') }}">Active Pages</a>
			@else
				<a class="btn btn-default btn-sm" href="{{ route('pages') }}">Active Pages</a>
			@endif
			@if(Input::get('withTrashed'))
				<a class="btn btn-success btn-sm disabled" href="{{ URL::to('admin/pages?withTrashed=true') }}">Active + Deleted Pages</a>
			@else
				<a class="btn btn-default btn-sm" href="{{ URL::to('admin/pages?withTrashed=true') }}">Active + Deleted Pages</a>
			@endif
			@if(Input::get('onlyTrashed'))
				<a class="btn btn-success btn-sm disabled" href="{{ URL::to('admin/pages?onlyTrashed=true') }}">Deleted Pages</a>
			@else
				<a class="btn btn-default btn-sm" href="{{ URL::to('admin/pages?onlyTrashed=true') }}">Deleted Pages</a>
			@endif
		</div>
		<div class="col-md-4">
			{{ Form::model($projects, ['method' => 'GET', 'route' => ['pages']]) }}
				<div class="input-group">
					{{ Form::select('projectId', $projects->lists('label', 'id'), Input::old('projectId'), ['class' => 'form-control']) }}
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">View Project Pages</button>
					</span>
				</div>
			{{ Form::close() }}
		</div>
	</div>

	<section class="panel panel-default">
		<table class="table b-light">
			<thead>
				<tr>
					<th class="col-sm-3">Page Title</th>
					<th class="col-sm-3">Slug</th>
					<th class="col-sm-3">Project</th>
					<th class="col-sm-1">Order</th>
					<th class="col-sm-2">Created</th>
				</tr>
			</thead>
			<tbody class="l-h-2x">
				@foreach ($pages as $page)
				<tr>
					<td>
						<a href="{{ route('edit/page', $page->id) }}"><strong>{{ $page->title }}</strong></a>
						<div class="table-actions">
							<a href="{{ route('edit/page', $page->id) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-original-title="Edit Page"><i class="fa fa-pencil"></i></a>
							<a href="{{ route('delete/page', $page->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-original-title="Delete Page"><i class="fa fa-trash-o"></i></a>
						</div>
					</td>
					<td>{{ $page->slug }}</td>
					<td><a href="{{ route('edit/project', $page->project->id) }}">{{ $page->project->website_title }}</a></td>
					<td>{{ $page->page_order }}</td>
					<td>{{ $page->created_at->diffForHumans() }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@stop