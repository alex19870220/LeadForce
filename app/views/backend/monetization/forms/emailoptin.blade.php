<!-- Label -->
<div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
	<label class="control-label" for="label">Label</label>
	<input type="text" class="form-control" name="label" value="{{ Input::old('label', $form->label) }}">
	{{ $errors->first('label', '<span class="help-block">:message</span>') }}
</div>

<!-- Title -->
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	<label class="control-label" for="title">Title <span class="text-muted">(form heading)</span></label>
	<input type="text" class="form-control" name="title" value="{{ Input::old('title', $form->title) }}">
	{{ $errors->first('title', '<span class="help-block">:message</span>') }}
</div>

<!-- Sub Text -->
<div class="form-group{{ $errors->has('sub_text') ? ' has-error' : '' }}">
	<label class="control-label" for="sub_text">Sub Text <span class="text-muted">(message below title)</span></label>
	<textarea class="form-control" name="sub_text" rows="5">{{ Input::old('sub_text', $form->sub_text) }}</textarea>
	{{ $errors->first('sub_text', '<span class="help-block">:message</span>') }}
</div>

<!-- Button Text -->
<div class="form-group{{ $errors->has('button_text') ? ' has-error' : '' }}">
	<label class="control-label" for="button_text">Button Text</label>
	<input type="text" class="form-control" name="button_text" value="{{ Input::old('button_text', $form->getFormData('button_text')) }}">
	{{ $errors->first('button_text', '<span class="help-block">:message</span>') }}
</div>

<!-- CSRF Token -->
{{ Form::token() }}