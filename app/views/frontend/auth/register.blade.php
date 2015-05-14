@extends($project->present()->templatePath.'.master')

{{-- Page title --}}
@section('title')
Register
@parent
@stop

{{-- Subtitle --}}
@section('subtitle')
	Try our tools for free. We know you'll love them
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">Create an account</header>
				<div class="panel-body">
					<form method="post" action="{{ route('register') }}" class="" autocomplete="off">
						<!-- CSRF Token -->
						{{ Form::token() }}

						<!-- First Name -->
						<div class="form-group{{ $errors->first('first_name', ' has-error') }}">
						<label class="control-label" for="first_name">First Name</label>
							<input type="text" class="form-control" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
							{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
						</div>

						<!-- Last Name -->
						<div class="form-group{{ $errors->first('last_name', ' has-error') }}">
							<label class="control-label" for="last_name">Last Name</label>
							<input type="text" class="form-control" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
							{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
						</div>

						<!-- Email -->
						<div class="form-group{{ $errors->first('email', ' has-error') }}">
							<label class="control-label" for="email">Email</label>
							<input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email') }}" />
							{{ $errors->first('email', '<span class="help-block">:message</span>') }}
						</div>

						<!-- Email Confirm -->
						<div class="form-group{{ $errors->first('email_confirm', ' has-error') }}">
							<label class="control-label" for="email_confirm">Confirm Email</label>
							<input type="text" class="form-control" name="email_confirm" id="email_confirm" value="{{ Input::old('email_confirm') }}" />
							{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
						</div>

						<!-- Password -->
						<div class="form-group{{ $errors->first('password', ' has-error') }}">
							<label class="control-label" for="password">Password</label>
							<input type="password" class="form-control" name="password" id="password" value="" />
							{{ $errors->first('password', '<span class="help-block">:message</span>') }}
						</div>

						<!-- Password Confirm -->
						<div class="form-group{{ $errors->first('password_confirm', ' has-error') }}">
							<label class="control-label" for="password_confirm">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" />
							{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
						</div>

						<hr>

						<!-- Form actions -->
						<div class="form-group">
							<button type="submit" class="btn btn-success">Register</button>
							<a class="btn btn-default" href="{{ route('home') }}">Cancel</a>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
@stop