@if (Sentry::getUser()->isSuperUser())
	@foreach ($permissions as $area => $permissions)
		<fieldset>
			<legend>{{ $area }}</legend>
			@foreach ($permissions as $permission)
				<div class="form-group clear m-b-sm">
					<label class="col-md-5 control-label" for="permissions[{{ $permission['permission'] }}]">{{ $permission['label'] }}</label>
					<div class="col-md-7">
						<div class="radio radio-inline i-checks m-t-none">
							<label for="{{ $permission['permission'] }}_allow">
								<input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($currentPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}>
								<i></i> Allow
							</label>
						</div>

						@if(! isset($isGroup))
							<div class="radio radio-inline i-checks m-t-none">
								<label for="{{ $permission['permission'] }}_deny">
									<input type="radio" value="-1" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($currentPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}>
									<i></i> Deny
								</label>
							</div>

							@if($permission['can_inherit'])
								<div class="radio radio-inline i-checks m-t-none">
									<label for="{{ $permission['permission'] }}_inherit">
										<input type="radio" value="0" id="{{ $permission['permission'] }}_inherit" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($currentPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
										<i></i> Inherit
									</label>
								</div>
							@endif
						@else
							<div class="radio radio-inline i-checks m-t-none">
								<label for="{{ $permission['permission'] }}_deny">
									<input type="radio" value="0" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($currentPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
									<i></i> Deny
								</label>
							</div>
						@endif
					</div>
				</div>
			@endforeach
		</fieldset>
	@endforeach
@endif