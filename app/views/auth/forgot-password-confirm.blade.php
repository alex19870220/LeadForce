@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	Forgot Password Confirm
@stop

@section('content')
	<form method="post" action="{{ route('forgot-password-confirm') }}" class="panel-body wrapper-lg">
		<!-- CSRF Token -->
		{{ Form::token() }}

		<!-- New Password -->
		<div class="control-group{{ $errors->first('password', ' has-error') }}">
			<label class="control-label" for="password">New Password</label>
			<div class="controls">
				<input type="password" class="form-control input-lg" name="password" id="password" value="{{ Input::old('password') }}" />
				{{ $errors->first('password', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Password Confirm -->
		<div class="control-group{{ $errors->first('password_confirm', ' has-error') }}">
			<label class="control-label" for="password_confirm">Password Confirmation</label>
			<div class="controls">
				<input type="password" class="form-control input-lg" name="password_confirm" id="password_confirm" value="{{ Input::old('password_confirm') }}" />
				{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Form actions -->
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-info">Submit</button>
				<a class="btn" href="{{ route('home') }}">Cancel</a>
			</div>
		</div>
	</form>
@stop