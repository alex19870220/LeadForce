<h4 class="m-t-none page-header">Widgets</h4>
<div class="row">
	<div class="col-md-12">
		<form class="widget-add" method="POST" action="{{ route('sidebars/add-widget') }}">
			<!-- CSRF Token -->
			{{ Form::token() }}
			<div class="form-group m-b-none">
				<div class="input-group">
					<select class="form-control" name="widget_id">
						@foreach($widgets as $widget)
							<option value="{{ $widget->id }}">{{ $widget->label }}</option>
						@endforeach
					</select>
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Widget</button>
					</span>
				</div>
				<span class="help-block text-muted">Add widgets to the sidebar below</span>
			</div>
		</form>
	</div>
</div>
<!-- Sidebar Setup -->
<div class="row">
	<div class="col-md-12">
		<h4 class="m-t page-header">Sidebar Setup</h4>
		@if(Route::currentRouteName() == 'sidebars/edit')
		<form method="POST" action="{{ route('sidebars/edit', $sidebar->id) }}">
		@else
		<form method="POST" action="{{ route('sidebars/create-sidebar') }}">
		@endif
			<!-- Label -->
			<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
				<label class="control-label" for="label">Label</label>
				<input type="text" class="form-control" name="label" value="{{ Input::old('label', $sidebar->label) }}">
				{{ $errors->first('label', '<span class="help-block">:message</span>') }}
			</div>
			<!-- Widgets -->
			<div class="form-group {{ $errors->has('widgets') ? 'has-error' : '' }}">
				<label class="control-label" for="widgets">Widgets</label>

				<ul class="widgetList list-group gutter list-group-sp clear sortable">
					@if($sidebar->widgets)
						@foreach($sidebar->widgets as $widget)
							@include('backend.appearance.partials.widget', ['widget' => $widget])
						@endforeach
					@endif
				</ul>

				<input type="hidden" class="widget-ids" name="widget-ids" id="widget-ids" />
			</div>
			<hr>
			<!-- Submit -->
			<div class="form-group">
				<!-- CSRF Token -->
				{{ Form::token() }}
				@if(Route::currentRouteName() == 'sidebars/edit')
				<button type="submit" class="btn btn-primary">Update</button>
				@else
				<button type="submit" class="btn btn-primary">Create</button>
				@endif
			</div>
		</form>
	</div>
</div>