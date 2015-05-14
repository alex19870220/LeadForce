@extends('emails.layouts.default')

@section('content')
	<p>Hello {{ $user->first_name }},</p>

	<p>Welcome to {{ Config::get('app.appname') }}! Please click on the following link to confirm your {{ Config::get('app.appname') }} account:</p>

	<p><a href="{{ $activationUrl }}">{{ $activationUrl }}</a></p>
@stop