@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Change Password
@stop

@section('content')
	<section class="panel panel-default">
		<header class="panel-heading font-bold">
			Change Your Password
		</header>
		<div class="panel-body">
			<form class="form-horizontal" method="POST" action="" autocomplete="off">
				<!-- Old Password -->
				<div class="form-group{{ $errors->first('old_password', ' has-error') }}">
					<label class="control-label col-md-3" for="old_password">Old Password</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="old_password" id="old_password" value="" />
						{{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- New Password -->
				<div class="form-group{{ $errors->first('password', ' has-error') }}">
					<label class="control-label col-md-3" for="password">New Password</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="password" id="password" value="" />
						{{ $errors->first('password', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Confirm New Password  -->
				<div class="form-group{{ $errors->first('password_confirm', ' has-error') }}">
					<label class="control-label col-md-3" for="password_confirm">Confirm New Password</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" />
						{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<hr>

				<!-- Form actions -->
				<div class="form-group">
					<div class="col-md-offset-3 col-md-3">
						<!-- CSRF Token -->
						{{ Form::token() }}
						<button type="submit" class="btn btn-primary">Update Password</button>
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