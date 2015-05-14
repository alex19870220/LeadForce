@extends('backend.template.master')

{{-- Page title --}}
@section('title')
User Management
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/user') }}" class="btn btn-info"><i class="fa fa-plus"></i> Create User</a>
@stop

{{-- Page content --}}
@section('content')
<section class="panel panel-default">
		<header class="panel-heading font-bold">
			Browsing All Users
		</header>
		<div class="row wrapper">
			<div class="col-md-6">
				@if(!Input::get('withTrashed') && !Input::get('onlyTrashed'))
					<a class="btn btn-success btn-sm disabled" href="{{ route('users') }}">Active Users</a>
				@else
					<a class="btn btn-default btn-sm" href="{{ route('users') }}">Active Users</a>
				@endif
				@if(Input::get('withTrashed'))
					<a class="btn btn-success btn-sm disabled" href="{{ URL::to('admin/users?withTrashed=true') }}">Active + Deleted Users</a>
				@else
					<a class="btn btn-default btn-sm" href="{{ URL::to('admin/users?withTrashed=true') }}">Active + Deleted Users</a>
				@endif
				@if(Input::get('onlyTrashed'))
					<a class="btn btn-success btn-sm disabled" href="{{ URL::to('admin/users?onlyTrashed=true') }}">Deleted Users</a>
				@else
					<a class="btn btn-default btn-sm" href="{{ URL::to('admin/users?onlyTrashed=true') }}">Deleted Users</a>
				@endif
			</div>
		</div>
	<table class="table table-striped b-t b-light">
		<thead>
			<tr>
				<th>ID</th>
				<th class="col-sm-3">Full Name</th>
				<th>Email</th>
				<th>Username</th>
				<th>Stats</th>
				<th>Status</th>
				<th>Last Login</th>
				<th>Join Date</th>
			</tr>
		</thead>
		<tbody class="l-h-2x">
			@foreach ($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>
					<a href="{{ route('update/user', $user->id) }}"><strong>{{ $user->first_name }} {{ $user->last_name }}</strong></a>
					@include('backend.users.partials.actions')
				</td>
				<td>{{ $user->email }}</td>
				<td><a href="{{ $user->present()->profileUrl }}">{{ $user->username }}</a></td>
				<td>
					<div class="row no-gutter">
						<div class="col-md-6">
							<span class="font-bold">{{ $user->projects->count() }}</span> Projects
						</div>
						<div class="col-md-6">
							<span class="font-bold">{{ $user->niches->count() }}</span> Niches
						</div>
					</div>
				</td>
				<td>
					{{ $user->isActivated() ? '<span class="label label-success">Active</span>' : '<span class="label bg-light dker">Inactive</span>' }}
					{{ $user->present()->title(true) }}
				</td>
				<td>
					@if(! is_null($user->last_login))
						{{ $user->last_login->diffForHumans() }}
					@endif
				</td>
				<td>{{ $user->created_at->diffForHumans() }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</section>
@stop
