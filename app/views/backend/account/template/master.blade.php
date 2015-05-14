@extends('frontend.template.master')

@section('content')
<div class="row">
	<!-- Account Navigation -->
	<div class="col-md-3">
		<div class="list-group bg-white">
			<a href="{{ route('account') }}" class="list-group-item{{ (Request::is('account') ? ' active' : '') }}">
				<i class="fa fa-chevron-right{{ (Request::is('account') ? '' : ' text-muted') }}"></i>
				<i class="fa fa-tachometer fa-fw"></i> Dashboard
			</a>
			<a href="{{ route('applist') }}" class="list-group-item{{ (Request::is('account/applist') ? ' active' : '') }}">
				<i class="fa fa-chevron-right{{ (Request::is('account/applist') ? '' : ' text-muted') }}"></i>
				<i class="fa fa-wrench fa-fw"></i> Your Apps
			</a>
			<a href="{{ route('profile') }}" class="list-group-item{{ (Request::is('account/profile') ? ' active' : '') }}">
				<i class="fa fa-chevron-right{{ (Request::is('account/profile') ? '' : ' text-muted') }}"></i>
				<i class="fa fa-user fa-fw"></i> Edit Profile
			</a>
			<a href="{{ route('change-email') }}" class="list-group-item{{ (Request::is('account/change-email') ? ' active' : '') }}">
				<i class="fa fa-chevron-right{{ (Request::is('account/change-email') ? '' : ' text-muted') }}"></i>
				<i class="fa fa-envelope fa-fw"></i> Change Email
			</a>
			<a href="{{ route('change-password') }}" class="list-group-item{{ (Request::is('account/change-password') ? ' active' : '') }}">
				<i class="fa fa-chevron-right{{ (Request::is('account/change-password') ? '' : ' text-muted') }}"></i>
				<i class="fa fa-lock fa-fw"></i> Change Password
			</a>
		</div>
	</div> <!-- End Left Column -->

	<!-- Account Navigation -->
	<div class="col-md-9">
		@yield('accountcontent')
	</div> <!-- End Left Column -->
</div>
@stop