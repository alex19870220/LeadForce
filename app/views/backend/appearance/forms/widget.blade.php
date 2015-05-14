<!-- Label -->
<div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
	<label class="control-label" for="label">Label</label>
	<input type="text" class="form-control" name="label" value="{{ Input::old('label', $widget->label) }}">
	{{ $errors->first('label', '<span class="help-block">:message</span>') }}
</div>

<!-- Title -->
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	<label class="control-label" for="title">Title</label>
	<input type="text" class="form-control" name="title" value="{{ Input::old('title', $widget->title) }}">
	{{ $errors->first('title', '<span class="help-block">:message</span>') }}
</div>

<!-- Type -->
<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
	<label class="control-label" for="type">Type</label>
	<select class="form-control" name="type" id="type">
		<!-- Custom HTML Widgets -->
		<optgroup label="{{ $widgetTypes->custom->label }}">
			@foreach($widgetTypes->custom->types as $widgetType => $widgetTypeLabel)
				@if($widget->type == $widgetType)
					<option value="{{ $widgetType }}" selected>{{ $widgetTypeLabel }}</option>
				@else
					<option value="{{ $widgetType }}">{{ $widgetTypeLabel }}</option>
				@endif
			@endforeach
		</optgroup>
		<!-- Monetization Widgets -->
		<optgroup label="{{ $widgetTypes->monetization->label }}">
			@foreach($widgetTypes->monetization->types as $widgetType => $widgetTypeLabel)
				@if($widget->type == $widgetType)
					<option value="{{ $widgetType }}" selected>{{ $widgetTypeLabel }}</option>
				@else
					<option value="{{ $widgetType }}">{{ $widgetTypeLabel }}</option>
				@endif
			@endforeach
		</optgroup>
	</select>
	{{ $errors->first('type', '<span class="help-block">:message</span>') }}
</div>

<!-- View -->
<div class="form-group widget-view{{ $errors->has('view') ? ' has-error' : '' }}">
	<label class="control-label" for="view">View Path</label>
	<input type="text" class="form-control" name="view" value="{{ Input::old('view', $widget->view) }}">
	{{ $errors->first('view', '<span class="help-block">:message</span>') }}
</div>

<!-- Form ID -->
<div class="form-group widget-view{{ $errors->has('form_id') ? ' has-error' : '' }}">
	<label class="control-label" for="form_id">Form ID <span class="text-muted">(For monetization forms)</span></label>
	<input type="number" class="form-control" name="form_id" min="0" value="{{ Input::old('form_id', $widget->form_id) }}">
	{{ $errors->first('form_id', '<span class="help-block">:message</span>') }}
</div>


<!-- Content -->
<div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
	<label class="control-label" for="contents">Content</label>
	<textarea class="form-control" name="contents" id="contents" rows="8">{{ Input::old('contents', $widget->contents) }}</textarea>
	{{ $errors->first('contents', '<span class="help-block">:message</span>') }}
</div>

<!-- CSRF Token -->
{{ Form::token() }}