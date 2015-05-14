@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	Forgot Password
@stop

{{-- Subtitle --}}
@section('subtitle')
	Tsk, tsk
@stop

@section('content')
	<form method="post" action="{{ route('forgot-password') }}" class="panel-body wrapper-lg">
		<!-- CSRF Token -->
		{{ Form::token() }}

		<!-- Email -->
		<div class="form-group{{ $errors->first('email', ' has-error') }}">
			<label class="control-label" for="email">Email</label>
			<input type="text" class="form-control input-lg" name="email" id="email" value="{{ Input::old('email') }}" />
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</div>

		<!-- Form actions -->
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</form>
@stop