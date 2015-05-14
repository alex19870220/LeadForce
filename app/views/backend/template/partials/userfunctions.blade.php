<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="thumb-sm avatar pull-left">
			<img alt="{{ $currentUser->username }}" src="{{ $currentUser->present()->getGravatar }}">
		</span>
		{{ $currentUser->first_name }}.{{ $currentUser->last_name }} <b class="caret"></b>
	</a>
	<ul class="dropdown-menu animated fadeInRight">
		<li><a href="{{ route('account/dashboard') }}">Dashboard</a></li>
		<li><a href="{{ route('account/settings') }}">Settings</a></li>
		<li><a href="{{ route('account/profile') }}">Edit Profile</a></li>
		<li><a href="{{ route('account/notifications') }}"><span class="badge bg-danger pull-right">3</span> Notifications</a></li>
		<li><a href="{{ route('account/support') }}">Support</a></li>
		@if(! empty($currentUser->username))
			<li class="divider"></li>
			<li><a href="{{ route('user/profile', $currentUser->username) }}">View Profile</a></li>
		@endif
		<li class="divider"></li>
		<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
	</ul>
</li>