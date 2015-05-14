<!DOCTYPE html>
<html class="app" lang="en">
<head>
	<meta charset="utf-8">
	<title>@yield('title') | {{ Config::get('app.appname') }} Admin
	</title>
	<!-- ~Bomb Diggity
	 ____  _           _   _       ____    _____           _
	/ ___|| |__  _   _| |_| |_ ___|  _ \  |_   _|__   ___ | |___
	\___ \| '_ \| | | | __| __/ _ \ |_) |   | |/ _ \ / _ \| / __|
	 ___) | | | | |_| | |_| ||  __/  _ <    | | (_) | (_) | \__ \
	|____/|_| |_|\__,_|\__|\__\___|_| \_\   |_|\___/ \___/|_|___/
	-->
	<meta content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" name="description">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<!-- Stylesheets and Javascripts -->
	@include('backend.template.assets.header')
	<!-- Other Stuff -->
	<link rel="icon" type="image/png" href="/images/favicon/circles-blue.png" />
	<link rel="shortcut icon" href="/images/favicon/circles-blue.png">
	<!--[if lt IE 9]>
	<script src="/assets/js/ie/html5shiv.js"></script>
	<script src="/assets/js/ie/respond.min.js"></script>
	<script src="/assets/js/ie/excanvas.js"></script>
	<![endif]-->
</head>

<body class="">
	<section class="vbox">
		<!-- Header -->
		@include('backend.template.header')

		<section class="hbox stretch">
			<!-- Left Sidebar -->
			<aside class="bg-black aside hidden-print hidden-xs" id="nav">
				@include('backend.template.sidebar_left')
			</aside><!-- /.Left Sidebar -->

			<!-- Content Begin -->
			<section id="content">
				<section class="hbox stretch">
					<!-- Sub Navigation -->
					@if(trim($__env->yieldContent('subnavigation')))
						<aside class="aside bg-light dker b-r" id="subNav">
							<div class="wrapper b-b header">Submenu</div>
							<ul class="nav">
								@yield('subnavigation')
							</ul>
						</aside>
					@endif

					<!-- Content -->
					<aside>
						<section class="vbox">
							<section class="scrollable padder" style="padding-bottom:60px;"><!-- Content Container -->

								<!-- Page Title & Widgets -->
								@include('backend.template.partials.title')

								<!-- Flash Messages -->
								@include('backend.template.partials.flashmessage')

								<!-- Content -->
								@yield('content')

								<div class="row padder-v">
									<p>&nbsp;</p>
								</div>

							</section><!-- /.Content Container -->
						</section>
					</aside>
					<!-- /.Content -->

					<!-- Right Sidebar -->
					<aside class="aside-md bg-black hide" id="sidebar">
						<section class="vbox animated fadeInRight">
							<section class="scrollable">
								<div class="wrapper"><strong>Sidebar</strong></div>
								<!-- Sidebar Content -->
							</section>
						</section>
					</aside>
					<!-- /.Right Sidebar -->

				</section>
				<a class="hide nav-off-screen-block" data-target="#nav,html" data-toggle="class:nav-off-screen,open" href="#"></a>
			</section>
		</section>
	</section>

	@if(trim($__env->yieldContent('modal')))
		<!-- Modal -->
		<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="post" action="{{ Request::url() }}" role="form">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="myModalLabel">@yield('modal-title')</h4>
						</div>
						<div class="modal-body">
							@yield('modal')
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">@yield('modal-button')</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endif

	<!-- Mad Javascripts Yo -->
	@include('backend.template.assets.footer')
</body>
</html>