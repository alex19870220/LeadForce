@extends('frontend.template.master')

{{-- Page title --}}
@section('title')
Forgot Password
@parent
@stop

{{-- Subtitle --}}
@section('subtitle')
	Tsk, tsk
@stop

@section('content')
	<div class="row">

		<div class="col-sm-6">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">Forgot Password</header>
				<div class="panel-body">

					<form method="post" action="">
						<!-- CSRF Token -->
						{{ Form::token() }}

						<!-- Email -->
						<div class="form-group{{ $errors->first('email', ' has-error') }}">
							<label class="control-label" for="email">Email</label>
							<input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email') }}" />
							{{ $errors->first('email', '<span class="help-block">:message</span>') }}
						</div>

						<!-- Form actions -->
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Submit</button>
								<a class="btn btn-default" href="{{ route('home') }}">Cancel</a>
							</div>
						</div>
					</form>

				</div>
			</section>
		</div>

	</div>
@stop