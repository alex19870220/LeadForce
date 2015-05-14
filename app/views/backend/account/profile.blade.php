@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Edit Profile
@stop

@section('content')
	<section class="panel panel-default">
		<header class="panel-heading font-bold">
			Your Profile
		</header>
		<div class="panel-body">
			<form class="form-horizontal" method="POST" action="{{ route('account/profile') }}" autocomplete="off">

				<h3 class="page-header m-t-none">Basic Information</h3>

				<!-- Username -->
				<div class="form-group {{ $errors->first('username', ' has-error') }}">
					<label class="control-label col-md-3" for="username">Username</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="username" value="{{ Input::old('username', $currentUser->username) }}" />
						{{ $errors->first('username', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- First Name -->
				<div class="form-group {{ $errors->first('first_name', ' has-error') }}">
					<label class="control-label col-md-3" for="first_name">First Name</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="first_name" value="{{ Input::old('first_name', $currentUser->first_name) }}" />
						{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Last Name -->
				<div class="form-group {{ $errors->first('last_name', ' has-error') }}">
					<label class="control-label col-md-3" for="last_name">Last Name</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="last_name" value="{{ Input::old('last_name', $currentUser->last_name) }}" />
						{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Website URL -->
				<div class="form-group {{ $errors->first('website', ' has-error') }}">
					<label class="control-label col-md-3" for="website">Website URL</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="website" value="{{ Input::old('website', $currentUser->website) }}" />
						{{ $errors->first('website', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Country -->
				<div class="form-group {{ $errors->first('country', ' has-error') }}">
					<label class="control-label col-md-3" for="country">Country</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="country" value="{{ Input::old('country', $currentUser->country) }}" />
						{{ $errors->first('country', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Gravatar Email -->
				<div class="form-group {{ $errors->first('gravatar', ' has-error') }}">
					<label class="control-label col-md-3" for="gravatar">Gravatar Email <span class="text-muted">(Private)</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="gravatar" value="{{ Input::old('gravatar', $currentUser->gravatar) }}" />
						{{ $errors->first('gravatar', '<span class="help-block">:message</span>') }}
						<span class="help-block">
							<a href="http://gravatar.com" target="_blank">
								<img src="{{ $currentUser->present()->getGravatar }}" width="30" height="30" />
								Change your avatar at Gravatar.com <i class="fa fa-external-link"></i>
							</a>
						</span>
					</div>
				</div>

				<h3 class="page-header">Contact Info</h3>

				<!-- Phone Number -->
				<div class="form-group {{ $errors->first('contact_info[phone_number]', ' has-error') }}">
					<label class="control-label col-md-3" for="contact_info[phone_number]">Phone Number</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="contact_info[phone_number]" value="{{ Input::old('contact_info[phone_number]', $currentUser->getContactInfo('phone_number')) }}" />
						{{ $errors->first('contact_info[phone_number]', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Contact Email -->
				<div class="form-group {{ $errors->first('contact_info[contact_email]', ' has-error') }}">
					<label class="control-label col-md-3" for="contact_info[contact_email]">Contact Email</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="contact_info[contact_email]" value="{{ Input::old('contact_info[contact_email]', $currentUser->getContactInfo('contact_email')) }}" />
						{{ $errors->first('contact_info[contact_email]', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<!-- Skype -->
				<div class="form-group {{ $errors->first('contact_info[skype]', ' has-error') }}">
					<label class="control-label col-md-3" for="contact_info[skype]">Skype</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="contact_info[skype]" value="{{ Input::old('contact_info[skype]', $currentUser->getContactInfo('skype')) }}" />
						{{ $errors->first('contact_info[skype]', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<hr>

				<!-- Form actions -->
				<div class="form-group ">
					<div class="col-md-offset-3 col-md-9">
						<!-- CSRF Token -->
						{{ Form::token() }}
						<button type="submit" class="btn btn-primary">Update your Profile</button>
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