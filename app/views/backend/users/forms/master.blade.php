@if(Route::currentRouteName() == 'update/user')
<form class="" method="post" action="{{ route('update/user', $user->id) }}" autocomplete="off">
@elseif(Route::currentRouteName() == 'create/user')
<form class="" method="post" action="{{ route('create/user') }}" autocomplete="off">
@endif
	<div class="row">
		<div class="col-md-4">
			<!-- CSRF Token -->
			{{ Form::token() }}
			<!-- First Name -->
			<div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
				<label class="control-label" for="first_name">First Name</label>
				<input type="text" class="form-control" name="first_name" id="first_name" value="{{ Input::old('first_name', $user->first_name) }}" />
				{{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
			</div>

			<!-- Last Name -->
			<div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
				<label class="control-label" for="last_name">Last Name</label>
				<input type="text" class="form-control" name="last_name" id="last_name" value="{{ Input::old('last_name', $user->last_name) }}" />
				{{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
			</div>

			<!-- Email -->
			<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
				<label class="control-label" for="email">Email</label>
				<input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email', $user->email) }}" />
				{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
			</div>

			<!-- Password -->
			<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				<label class="control-label" for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password" value="" />
				{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
			</div>

			<!-- Password Confirm -->
			<div class="form-group {{ $errors->has('password_confirm') ? 'has-error' : '' }}">
				<label class="control-label" for="password_confirm">Confirm Password</label>
				<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" />
				{{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
			</div>

			<!-- Activation Status -->
			<div class="form-group {{ $errors->has('activated') ? 'has-error' : '' }}">
				<label class="control-label" for="activated">User Activated</label>
				@if(Route::currentRouteName() == 'update/user')
					<select class="form-control"{{ ($user->id === Sentry::getId() ? ' disabled="disabled"' : '') }} name="activated" id="activated">
						<option value="1"{{ ($user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.yes')</option>
						<option value="0"{{ ( ! $user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.no')</option>
					</select>
				@elseif(Route::currentRouteName() == 'create/user')
					<select name="activated" class="form-control" id="activated">
						<option value="1"{{ (Input::old('activated', 0) === 1 ? ' selected="selected"' : '') }}>@lang('general.yes')</option>
						<option value="0"{{ (Input::old('activated', 0) === 0 ? ' selected="selected"' : '') }}>@lang('general.no')</option>
					</select>
				@endif
				{{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
			</div>
		</div>

		<div class="col-md-8">
			<!-- Groups -->
			<div class="form-group {{ $errors->has('groups') ? 'has-error' : '' }}">
				<label class="control-label" for="groups">Groups</label>
				@if(Route::currentRouteName() == 'update/user')
					<select class="form-control" name="groups[]" id="groups[]" multiple>
						@foreach ($groups as $group)
							<option value="{{ $group->id }}"{{ array_key_exists($group->id, $userGroups) ? ' selected="selected"' : '' }}>{{ $group->name }}</option>
						@endforeach
					</select>
				@elseif(Route::currentRouteName() == 'create/user')
					<select name="groups[]" class="form-control" id="groups[]" multiple="multiple">
						@foreach ($groups as $group)
							<option value="{{ $group->id }}"{{ in_array($group->id, $selectedGroups) ? ' selected="selected"' : '' }}>{{ $group->name }}</option>
						@endforeach
					</select>
				@endif
				<span class="help-block">Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.</span>
			</div>

			@include('backend.groups.partials.permissions', ['permissions' => $permissions, 'currentPermissions' => $userPermissions])

		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<!-- Form Actions -->
			<div class="form-group">
				@if(Route::currentRouteName() == 'update/user')
					<button type="submit" class="btn btn-success">Update User</button>
				@elseif(Route::currentRouteName() == 'create/user')
					<button type="submit" class="btn btn-success">Create User</button>
				@endif
				<a class="btn btn-link" href="{{ route('users') }}">Cancel</a>
			</div>
		</div>
	</div>
</form>