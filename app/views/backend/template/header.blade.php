<header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
	<!-- Logo -->
	<div class="navbar-header aside-md dk">
		<a class="btn btn-link visible-xs fa fa-bars" data-target="#nav,html" data-toggle="class:nav-off-screen,open"></a>
		<a class="navbar-brand" href="{{ route('dashboard') }}">
			<img alt="scale" class="m-r-sm" src="/images/logo.png">
			<span class="hidden-nav-xs">{{ Config::get('app.appname') }}</span>
		</a>
		<a class="btn btn-link visible-xs fa fa-cog" data-target=".user" data-toggle="dropdown"></a>
	</div>

	<!-- First Header Group -->
	<ul class="nav navbar-nav hidden-xs">
		<!-- App Switcher -->
		{{-- @include('backend.template.partials.switchapp') --}}
		<!-- Queue Watch -->
		@include('backend.template.partials.queue-eye')
		<!-- App Info -->
		@include('backend.template.partials.appinfo')
	</ul>

	<!-- Search Bar -->
	{{--@include('backend.template.partials.search')--}}

	<!-- User Functions -->
	<ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
		<!-- Friend Requests -->
		@include('backend.template.partials.friendrequests')
		<!-- Notifications -->
		@include('backend.template.partials.notifications')
		<!-- Profile Dropdown -->
		@include('backend.template.partials.userfunctions')
	</ul>

</header>