@extends('frontend.account.template.master')

{{-- Page title --}}
@section('title')
Change Email
@stop

@section('accountcontent')
	<section class="panel panel-default">
		<header class="panel-heading">Change Your Email Address</header>
		<section class="panel-body">
			<form method="post" action="" autocomplete="off">
				<!-- CSRF Token -->
				{{ Form::token() }}

				<!-- Form type -->
				<input type="hidden" name="formType" value="change-email" />

				<!-- New Email -->
				<div class="form-group{{ $errors->first('email', ' has-error') }}">
					<label class="control-label" for="email">New Email</label>
					<input type="text" class="form-control" name="email" id="email" value="" />
					{{ $errors->first('email', '<span class="help-block">:message</span>') }}
				</div>

				<!-- Confirm New Email -->
				<div class="form-group{{ $errors->first('email_confirm', ' has-error') }}">
					<label class="control-label" for="email_confirm">Confirm New Email</label>
					<input type="text" class="form-control" name="email_confirm" id="email_confirm" value="" />
					{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
				</div>

				<!-- Current Password -->
				<div class="form-group{{ $errors->first('current_password', ' has-error') }}">
					<label class="control-label" for="current_password">Current Password</label>
					<input type="password" class="form-control" name="current_password" id="current_password" value="" />
					{{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
				</div>

				<hr>

				<!-- Form actions -->
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update Email</button>
					<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
				</div>
			</form>
		</section>
	</section>
@stop
