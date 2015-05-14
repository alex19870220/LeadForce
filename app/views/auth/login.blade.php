@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	Login
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<form method="post" action="{{ route('login') }}" class="panel-body wrapper-lg">
		<!-- CSRF Token -->
		{{ Form::token() }}

		<div class="form-group{{ $errors->first('email', ' has-error') }}">
			<label class="control-label" for="email">Email</label>
			<input type="text" class="form-control input-lg" name="email" id="email" value="{{ Input::old('email') }}" />
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</div>

		<div class="form-group{{ $errors->first('password', ' has-error') }}">
			<label class="control-label" for="password">Password</label>
			<input type="password" class="form-control input-lg" name="password" id="password" value="{{ Input::old('password') }}">
			{{ $errors->first('password', '<span class="help-block">:message</span>') }}
		</div>

		<div class="form-group">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember-me" id="remember-me" value="1" /> Remember me
				</label>
			</div>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-lg btn-primary btn-block">Sign In</button>
		</div>

		<div class="text-center m-t m-b">
			<a href="{{ route('forgot-password') }}"><small>Forgot password?</small></a>
		</div>
	</form>
@stop