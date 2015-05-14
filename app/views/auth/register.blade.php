@extends('auth.template.master')

{{-- Page title --}}
@section('title')
	Register
@stop

{{-- Subtitle --}}
@section('subtitle')
	Try our tools for free. We know you'll love them
@stop

@section('content')
	<form method="post" action="{{ route('register') }}" class="" autocomplete="off">
		<!-- CSRF Token -->
		{{ Form::token() }}

		<div class="list-group">
			<div class="list-group-item">
				<!-- Name -->
				<label class="control-label sr-only" for="first_name">Name</label>
				<input type="text" class="form-control no-border" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" placeholder="Name" />
				{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
			</div>

			<div class="list-group-item">
				<!-- Email -->
				<label class="control-label sr-only" for="email">Email</label>
				<input type="text" class="form-control no-border" name="email" id="email" value="{{ Input::old('email') }}" placeholder="Email" />
				{{ $errors->first('email', '<span class="help-block">:message</span>') }}
			</div>
			<div class="list-group-item">
				<!-- Email Confirm -->
				<label class="control-label sr-only" for="email_confirm">Confirm Email</label>
				<input type="text" class="form-control no-border" name="email_confirm" id="email_confirm" value="{{ Input::old('email_confirm') }}" placeholder="Email Confirm" />
				{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
			</div>

			<div class="list-group-item">
				<!-- Password -->
				<label class="control-label sr-only" for="password">Password</label>
				<input type="password" class="form-control no-border" name="password" id="password" value="" placeholder="Password" />
				{{ $errors->first('password', '<span class="help-block">:message</span>') }}
			</div>
			<div class="list-group-item">
				<!-- Password Confirm -->
				<label class="control-label sr-only" for="password_confirm">Confirm Password</label>
				<input type="password" class="form-control no-border" name="password_confirm" id="password_confirm" value="" placeholder="Password Confirm" />
				{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<div class="checkbox m-b">
			<label><input type="checkbox"> Agree the <a href="#">terms and policy</a></label>
		</div>

		<!-- Form actions -->
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
		<div class="line line-dashed"></div>
		<p class="text-muted text-center"><small>Already have an account?</small></p>
		<a class="btn btn-lg btn-default btn-block" href="{{ route('login') }}">Sign in</a>
	</form>
@stop