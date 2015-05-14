@if (Sentry::check())
	<li class="m-l-sm" class="user-menu">
		<div class="m-t-sm">
			<a class="btn btn-sm btn-default dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="{{ route('account') }}">
				<i class="fa fa-dashboard"></i> {{ Sentry::getUser()->first_name }}
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<li><a href="{{ route('account') }}"><i class="fa fa-dashboard text-muted"></i> Dashboard</a></li>
				<li class="divider"></li>
				@if(Sentry::getUser()->hasAccess('admin'))
					<li class="divider"></li>
				@endif
				<li class="divider"></li>
				<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out text-muted"></i> Logout</a></li>
			</ul>
		</div>
	</li>
@else
	<li class="m-l-sm" class="user-menu">
		<div class="m-t-sm">
			<a href="{{ route('login') }}" class="btn btn-sm btn-default">Login</a>
			<a href="{{ route('register') }}" class="btn btn-sm btn-success m-l">Register</a>
		</div>
	</li>
@endif