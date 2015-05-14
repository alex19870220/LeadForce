<!-- Label -->
<div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
	<label class="control-label" for="label">Label</label>
	<input type="text" class="form-control" name="label" value="{{ Input::old('label', $category->label) }}">
	{{ $errors->first('label', '<span class="help-block">:message</span>') }}
</div>

<!-- CSRF Token -->
{{ Form::token() }}