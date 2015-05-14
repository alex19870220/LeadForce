<!-- Label -->
<div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
	<label class="control-label" for="label">Label</label>
	<input type="text" class="form-control" name="label" value="{{ Input::old('label', $form->label) }}">
	{{ $errors->first('label', '<span class="help-block">:message</span>') }}
</div>

<!-- Title -->
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	<label class="control-label" for="title">Title</label>
	<input type="text" class="form-control" name="title" value="{{ Input::old('title', $form->title) }}">
	{{ $errors->first('title', '<span class="help-block">:message</span>') }}
</div>

<!-- Style -->
<div class="form-group{{ $errors->has('style') ? ' has-error' : '' }}">
	<label class="control-label" for="style">Style</label>
	<select class="form-control" name="style">
		@foreach(LeadgenFormHelper::getFormStyles() as $formStyle => $formStyleData)
			@if($form->style == $formStyle)
				<option value="{{ $formStyle }}" selected>{{ $formStyleData['label'] }}</option>
			@else
				<option value="{{ $formStyle }}">{{ $formStyleData['label'] }}</option>
			@endif
		@endforeach
	</select>
	{{ $errors->first('style', '<span class="help-block">:message</span>') }}
</div>

<!-- CSRF Token -->
{{ Form::token() }}