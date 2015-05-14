<div class="row">
	<div class="col-md-12">
		<select class="selectpicker" data-style="btn-sm btn-default" name="category_id">
			<option>All Categories</option>
			@foreach($allCategories as $category)
				@if(Session::get('category_id') == $category->id)
					<option value="{{ $category->id }}" selected>{{ $category->label }}</option>
				@else
					<option value="{{ $category->id }}">{{ $category->label }}</option>
				@endif
			@endforeach
		</select>

		<div class="btn-group m-l" data-toggle="buttons">

			@if(! Session::has('active_status') || Session::get('active_status') == 'onlyActive')
				<label class="btn btn-sm btn-default active">
					<input type="radio" name="active_status" value="onlyActive" autocomplete="off" data-toggle="button" checked="">
					Active
				</label>
			@else
				<label class="btn btn-sm btn-default">
					<input type="radio" name="active_status" value="onlyActive" autocomplete="off" data-toggle="button">
					Active
				</label>
			@endif

			@if(Session::get('active_status') == 'withTrashed')
				<label class="btn btn-sm btn-default active">
					<input type="radio" name="active_status" value="withTrashed" autocomplete="off" data-toggle="button" checked="">
					All
				</label>
			@else
				<label class="btn btn-sm btn-default">
					<input type="radio" name="active_status" value="withTrashed" autocomplete="off" data-toggle="button">
					All
				</label>
			@endif

			@if(Session::get('active_status') == 'onlyTrashed')
				<label class="btn btn-sm btn-default active">
					<input type="radio" name="active_status" value="onlyTrashed" autocomplete="off" data-toggle="button" checked="">
					Deleted
				</label>
			@else
				<label class="btn btn-sm btn-default">
					<input type="radio" name="active_status" value="onlyTrashed" autocomplete="off" data-toggle="button">
					Deleted
				</label>
			@endif
		</div>

		<div class="btn-group m-l" data-toggle="buttons">
			@if(! Session::has('project_owner') || Session::get('project_owner') == 'current_user')
				<label class="btn btn-sm btn-default active">
					<input type="radio" name="project_owner" value="current_user" autocomplete="off" checked="">
					My Projects
				</label>
			@else
				<label class="btn btn-sm btn-default">
					<input type="radio" name="project_owner" value="current_user" autocomplete="off">
					My Projects
				</label>
			@endif

			@if(Session::get('project_owner') == 'all_users')
				<label class="btn btn-sm btn-default active">
					<input type="radio" name="project_owner" value="all_users" autocomplete="off" checked="">
					All Projects
				</label>
			@else
				<label class="btn btn-sm btn-default">
					<input type="radio" name="project_owner" value="all_users" autocomplete="off">
					All Projects
				</label>
			@endif
		</div>

		{{ Form::token() }}
		<button type="submit" class="btn btn-sm btn-primary m-l">Update Filter</button>
	</div>
</div>