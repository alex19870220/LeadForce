@extends($project->present()->templatePath.'.master')

{{-- Page title --}}
@section('title')
Login
@parent
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<div class="row">

		@if (!Sentry::check())
		<div class="col-sm-6">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">Login</header>
				<div class="panel-body">

					<form method="post" action="{{ route('login') }}" class="">
						<!-- CSRF Token -->
						{{ Form::token() }}

						<div class="form-group{{ $errors->first('email', ' has-error') }}">
							<label class="control-label" for="email">Email</label>
							<input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email') }}" />
							{{ $errors->first('email', '<span class="help-block">:message</span>') }}
						</div>
						<div class="form-group{{ $errors->first('password', ' has-error') }}">
							<label class="control-label" for="password">Password</label>
							<input type="password" class="form-control" name="password" id="password" value="{{ Input::old('password') }}">
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
							<button type="submit" class="btn btn-success">Sign in</button>
							<a href="{{ route('home') }}" class="btn btn-default">Cancel</a>
							<a href="{{ route('forgot-password') }}" class="btn btn-link">Forgot password?</a>
						</div>
					</form>
				</div>
			</section>
		</div>
		@else
			<h2>You're aready logged in, {{ Sentry::getUser()->first_name }}!</h2>
		@endif

	</div>
@stop