<form class="form-horizontal" method="POST" action="" autocomplete="off">
	<div class="row">
		<!-- Left Half -->
		<div class="col-md-4">
			<h4 class="page-header m-t-none">Group Info</h4>
			<!-- Group Setup -->
			<div class="form-group {{ $errors->has('name') ? 'error' : '' }}">
				<label class="control-label col-md-3" for="name">Name</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" id="name" value="{{ Input::old('name', $group->name) }}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<!-- CSRF Token -->
					{{ Form::token() }}
					@if(Route::currentRouteName() == 'create/group')
						<button type="submit" class="btn btn-primary">Create User Group</button>
					@else
						<button type="submit" class="btn btn-primary">Update User Group</button>
					@endif
				</div>
			</div>
		</div>
		<!-- Right Half -->
		<div class="col-md-8">
			<h4 class="page-header m-t-none">Group Permissions</h4>
			@include('backend.groups.partials.permissions', ['permissions' => $permissions, 'currentPermissions' => $groupPermissions, 'isGroup' => true])
		</div>
	</div>
</form>