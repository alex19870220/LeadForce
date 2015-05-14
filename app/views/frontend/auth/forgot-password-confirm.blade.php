@extends('frontend.template.master')

@section('content')
	<div class="row">

		<div class="col-sm-6">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">Login</header>
				<div class="panel-body">

					<form method="post" action="">
						<!-- CSRF Token -->
						{{ Form::token() }}

						<!-- New Password -->
						<div class="control-group{{ $errors->first('password', ' has-error') }}">
							<label class="control-label" for="password">New Password</label>
							<div class="controls">
								<input type="password" name="password" id="password" value="{{ Input::old('password') }}" />
								{{ $errors->first('password', '<span class="help-block">:message</span>') }}
							</div>
						</div>

						<!-- Password Confirm -->
						<div class="control-group{{ $errors->first('password_confirm', ' has-error') }}">
							<label class="control-label" for="password_confirm">Password Confirmation</label>
							<div class="controls">
								<input type="password" name="password_confirm" id="password_confirm" value="{{ Input::old('password_confirm') }}" />
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

				</div>
			</section>
		</div>

	</div>
@stop