<div class="table-actions">
	<a href="{{ route('update/user', $user->id) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-original-title="Edit User"><i class="fa fa-pencil"></i></a>
	@if (! is_null($user->deleted_at))
		<a href="{{ route('restore/user', $user->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-original-title="Restore User" data-confirm><i class="fa fa-magic"></i></a>
	@else
		@if (Sentry::getId() !== $user->id)
			<a href="{{ route('delete/user', $user->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-original-title="Delete User" data-confirm><i class="fa fa-trash-o"></i></a>
		@else
			<span class="btn btn-xs btn-danger disabled" data-toggle="tooltip" data-original-title="Cannot Delete User"><i class="fa fa-trash-o"></i></span>
		@endif
	@endif
</div>