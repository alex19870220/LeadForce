<div class="form-group">
	<label class="col-md-3 control-label" for="options[{{ $option }}]">{{ $label }}</label>
	<div class="col-md-9">
		<select class="form-control" name="options[{{ $option }}]">
			<option></option>
			@foreach($emailOptins as $emailOptin => $emailOptinLabel)
				@if($project->getOption($option) == $emailOptin)
					<option value="{{ $emailOptin }}" selected>{{$emailOptinLabel }}</option>
				@else
					<option value="{{ $emailOptin }}">{{ $emailOptinLabel }}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>