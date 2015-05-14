@extends('backend.template.master')

{{-- Page title --}}
@section('title')
User Group Management
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/group') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Create Group</a>
@stop

{{-- Page content --}}
@section('content')
	<section class="panel panel-default" style="overflow: visible;">
		<header class="panel-heading font-bold">
			All User Groups
		</header>
		<table class="table table-striped b-light">
			<thead>
				<tr>
					<th class="col-sm-1">ID</th>
					<th class="col-sm-5">Group Name</th>
					<th class="col-sm-1"># Users</th>
					<th class="col-sm-1">Created on</th>
				</tr>
			</thead>
			<tbody class="l-h-2x">
				@if ($groups->count() >= 1)
					@foreach ($groups as $group)
					<tr>
						<td>{{ $group->id }}</td>
						<td>
							<a href="{{ route('update/group', $group->id) }}"><strong>{{ $group->name }}</strong></a>
							<div class="table-actions">
								<a href="{{ route('update/group', $group->id) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-original-title="Edit Group"><i class="fa fa-pencil"></i></a>
								<a href="{{ route('delete/group', $group->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-original-title="Delete Group"><i class="fa fa-trash-o"></i></a>
							</div>
						</td>
						<td>{{ $group->users()->count() }}</td>
						<td>{{ $group->created_at->diffForHumans() }}</td>
					</tr>
					@endforeach
				@else
				<tr>
					<td colspan="5">No results</td>
				</tr>
				@endif
			</tbody>
		</table>
		</div>
	</section>
@stop