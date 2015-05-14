@extends('frontend.account.template.master')

{{-- Page title --}}
@section('title')
Change Password
@stop

@section('accountcontent')
	<section class="panel panel-default">
		<header class="panel-heading">Change Your Password</header>
		<section class="panel-body">
			<form method="post" action="" class="" autocomplete="off">
				<!-- CSRF Token -->
				{{ Form::token() }}

				<!-- Old Password -->
				<div class="form-group{{ $errors->first('old_password', ' has-error') }}">
					<label class="control-label" for="old_password">Old Password</label>
					<input type="password" class="form-control" name="old_password" id="old_password" value="" />
					{{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
				</div>

				<!-- New Password -->
				<div class="form-group{{ $errors->first('password', ' has-error') }}">
					<label class="control-label" for="password">New Password</label>
					<input type="password" class="form-control" name="password" id="password" value="" />
					{{ $errors->first('password', '<span class="help-block">:message</span>') }}
				</div>

				<!-- Confirm New Password  -->
				<div class="form-group{{ $errors->first('password_confirm', ' has-error') }}">
					<label class="control-label" for="password_confirm">Confirm New Password</label>
					<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" />
					{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
				</div>

				<hr>

				<!-- Form actions -->
				<div class="form-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">Update Password</button>
						<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
					</div>
				</div>
			</form>
		</section>
	</section>
@stop

@section('contenxt')
	<div class="tabbable tabs-left">
		<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li{{ Session::get('form', 'update-details') == 'update-details' ? ' class="active"' : '' }}><a href="#tab-general" data-toggle="tab">Profile</a></li>
			<li{{ Session::get('form') == 'change-password' ? ' class="active"' : '' }}><a href="#tab-password" data-toggle="tab">Change Password</a></li>
			<li{{ Session::get('form') == 'change-email' ? ' class="active"' : '' }}><a href="#tab-email" data-toggle="tab">Change Email</a></li>
		</ul>

		<!-- Tabs content -->
		<div class="tab-content">

			<!-- Change Email -->
			<div class="tab-pane{{ Session::get('form') == 'change-email' ? ' active' : '' }}" id="tab-email">
				<form method="post" action="" class="form-horizontal" autocomplete="off">
					<!-- CSRF Token -->
					{{ Form::token() }}

					<!-- Form type -->
					<input type="hidden" name="formType" value="change-email" />

					<!-- Old Password -->
					<div class="form-group{{ $errors->first('old_password', ' has-error') }}">
						<label class="control-label" for="old_password">Old Password</label>
						<div class="controls">
							<input type="password" name="old_password" id="old_password" value="" />
							{{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
						</div>
					</div>

					<!-- New Email -->
					<div class="form-group{{ $errors->first('email', ' has-error') }}">
						<label class="control-label" for="email">New Email</label>
						<div class="controls">
							<input type="text" name="email" id="email" value="" />
							{{ $errors->first('email', '<span class="help-block">:message</span>') }}
						</div>
					</div>

					<!-- Confirm New Email -->
					<div class="form-group{{ $errors->first('email_confirm', ' has-error') }}">
						<label class="control-label" for="email_confirm">Confirm New Email</label>
						<div class="controls">
							<input type="text" name="email_confirm" id="email_confirm" value="" />
							{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
						</div>
					</div>

					<!-- Form actions -->
					<div class="form-group">
						<div class="controls">
							<a class="btn" href="{{ route('home') }}">Cancel</a>

							<button type="submit" class="btn btn-info">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
