@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Change Email
@stop

@section('content')
	<section class="panel panel-default">
		<header class="panel-heading">Change Your Email Address</header>
		<div class="panel-body">
			<form class="form-horizontal" method="POST" action="" autocomplete="off">
				<!-- Form type -->
				<input type="hidden" name="formType" value="change-email" />

				<!-- New Email -->
				<div class="form-group{{ $errors->first('email', ' has-error') }}">
					<label class="control-label col-md-3" for="email">New Email</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="email" id="email" value="" />
						{{ $errors->first('email', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Confirm New Email -->
				<div class="form-group{{ $errors->first('email_confirm', ' has-error') }}">
					<label class="control-label col-md-3" for="email_confirm">Confirm New Email</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="email_confirm" id="email_confirm" value="" />
						{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Current Password -->
				<div class="form-group{{ $errors->first('current_password', ' has-error') }}">
					<label class="control-label col-md-3" for="current_password">Current Password</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="current_password" id="current_password" value="" />
						{{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<hr>

				<!-- Form actions -->
				<div class="form-group">
					<div class="col-md-offset-3 col-md-9">
						<!-- CSRF Token -->
						{{ Form::token() }}
						<button type="submit" class="btn btn-primary">Update Email</button>
						<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
					</div>
				</div>
			</form>
		</div>
	</section>
@stop

{{-- Sub navigation --}}
@section('subnavigation')
	@include('backend.account.template.subnav')
@stop