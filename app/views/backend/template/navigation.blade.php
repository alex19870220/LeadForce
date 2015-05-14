
<!-- Dashboard -->
<li{{ (!Route::is('dashboard')) ? '' :' class="active"' }}>
	<a href="{{ route('dashboard') }}"{{ (!Route::is('dashboard')) ? '' :' class="active"' }}>
		<i class="fa fa-dashboard icon"><b class="bg-info"></b></i> <span>Dashboard</span>
	</a>
</li>

<!-- Projects / Pages -->
<li{{ (Request::is('admin/projects*') || Request::is('admin/pages*')) ? ' class="active"' : '' }}>
	<a href="#" class="auto">
		<i class="fa fa-folder-open-o"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Projects</span>
	</a>
	<ul class="nav dk">
		<li{{ (! Route::is('projects') && ! Route::is('edit/project')) ? '' :' class="active"' }}><a href="{{ route('projects') }}"><i class="i i-dot"></i> <span>All Projects</span></a></li>
		{{ HTML::liLinkNav('create/project', 'Create Project') }}
		<!-- Project Pages -->
		<li{{ (! Request::is('admin/pages*')) ? '' :' class="active"' }}>
			<a class="auto" href="#form">
				<span class="pull-right text-muted">
					<i class="i i-circle-sm-o text"></i>
					<i class="i i-circle-sm text-active"></i>
				</span>
			<i class="i i-dot"></i> <span>Pages</span></a>
			<ul class="nav dker">
				{{ HTML::liLinkNav('pages', 'All Pages') }}
				{{ HTML::liLinkNav('create/page', 'Create Page') }}
			</ul>
		</li>
		{{ HTML::liLinkNav('projects/stats', 'Statistics') }}
	</ul>
</li>

<!-- Project Categories -->
<li{{ (Request::is('admin/categories*')) ? ' class="active"' : '' }}>
	<a href="#" class="auto">
		<i class="fa fa-random"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Categories</span>
	</a>
	<ul class="nav dk">
		{{ HTML::liLinkNav('categories', 'All Categories') }}
		{{ HTML::liLinkNav('categories/bulk-updates', 'Bulk Updates') }}
	</ul>
</li>

<!-- Niches -->
<li{{ (Request::is('admin/niches*')) ? ' class="active"' : '' }}>
	<a href="#" class="auto">
		<i class="fa fa-building-o"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Niches</span>
	</a>
	<ul class="nav dk">
		<li{{ (! Route::is('niches') && ! Route::is('edit/niche')) ? '' :' class="active"' }}><a href="{{ route('niches') }}"><i class="i i-dot"></i> <span>All Niches</span></a></li>
		{{ HTML::liLinkNav('create/niche', 'Create Niche') }}
	</ul>
</li>

<!-- Appearance -->
<li{{ (Request::is('admin/appearance*')) ? ' class="active"' : '' }}>
	<a href="#" class="auto">
		<i class="fa fa-picture-o"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Appearance</span>
	</a>
	<ul class="nav dk">
		{{ HTML::liLinkNav('images', 'Images') }}
		{{ HTML::liLinkNav('widgets', 'Widgets') }}
		<li{{ (! Route::is('sidebars') && ! Route::is('sidebars/edit')) ? '' :' class="active"' }}><a href="{{ route('sidebars') }}"><i class="i i-dot"></i> <span>Sidebars</span></a></li>
	</ul>
</li>

<!-- Monetization -->
<li{{ (! Request::is('admin/monetization*')) ? '' :' class="active"' }}>
	<a href="#" class="auto">
		<i class="fa fa-usd"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Monetization</span>
	</a>
	<ul class="nav dk">
		{{ HTML::liLinkNav('adsense', 'Adsense') }}
		{{ HTML::liLinkNav('affiliate-offers', 'Affiliate Offers') }}
		{{ HTML::liLinkNav('cloaking', 'Cloaking') }}
		{{ HTML::liLinkNav('email-optins', 'Email Optins') }}
		{{ HTML::liLinkNav('homeadvisor', 'HomeAdvisor') }}
		{{ HTML::liLinkNav('leadgen-forms', 'Lead Generation') }}
	</ul>
</li>

<!-- Indexer -->
<li{{ (! Request::is('admin/indexer*')) ? '' :' class="active"' }}>
	<a href="#" class="auto">
		<i class="fa fa-google"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Indexer</span>
	</a>
	<ul class="nav dk">
		{{ HTML::liLinkNav('indexer', 'Campaigns') }}
		{{ HTML::liLinkNav('indexer/settings', 'Settings') }}
	</ul>
</li>

<!-- Users -->
<li{{ (! Request::is('admin/users*') && ! Request::is('admin/groups*')) ? '' :' class="active"' }}>
	<a href="#" class="auto">
		<i class="fa fa-users"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Users</span>
	</a>
	<ul class="nav dk">
		{{ HTML::liLinkNav('users', 'All Users') }}
		{{ HTML::liLinkNav('create/user', 'Create User') }}
		{{ HTML::liLinkNav('groups', 'Groups') }}
		{{ HTML::liLinkNav('create/group', 'Create Group') }}
	</ul>
</li>

<!-- Tools -->
<li{{ (! Request::is('admin/tools*')) ? '' :' class="active"' }}>
	<a href="#" class="auto">
		<i class="fa fa-wrench"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Tools</span>
	</a>
	<ul class="nav dk">
		{{ HTML::liLinkNav('tools/keyword-grouper', 'Keyword Grouper') }}
		{{ HTML::liLinkNav('tools/keyword-multiplier', 'Keyword Multiplier') }}
	</ul>
</li>

<!-- Settings -->
<li{{ (! Request::is('admin/settings*')) ? '' :' class="active"' }}>
	<a href="#" class="auto">
		<i class="fa fa-gear"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>Settings</span>
	</a>
	<ul class="nav dk">
		{{ HTML::liLinkNav('geolocation', 'Geolocation') }}
		{{ HTML::liLinkNav('proxies', 'Proxies') }}
		{{ HTML::liLinkNav('spintax', 'Spintax') }}
	</ul>
</li>

<!-- System -->
<li{{ (! Request::is('admin/system*')) ? '' :' class="active"' }}>
	<a href="#" class="auto">
		<i class="fa fa-database"><b class="bg-info"></b></i>
		<span class="pull-right"><i class="fa fa-angle-down text"></i><i class="fa fa-angle-up text-active"></i></span>
		<span>System</span>
	</a>
	<ul class="nav dk">
		{{ HTML::liLinkNav('bulk/project-updater', 'Bulk Updates') }}
		{{ HTML::liLinkNav('queues', 'Queues') }}
		{{ HTML::liLinkNav('cache', 'Cache') }}
		<li><a href="#" class="auto"><i class="fa fa-angle-right"></i><span>Logs</span></a></li>
	</ul>
</li>
