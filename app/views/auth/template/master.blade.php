<!DOCTYPE html>
<html class="app authtemplate" lang="en">
<head>
	<!-- ~Bomb Diggity
	 ____  _           _   _       ____    _____           _
	/ ___|| |__  _   _| |_| |_ ___|  _ \  |_   _|__   ___ | |___
	\___ \| '_ \| | | | __| __/ _ \ |_) |   | |/ _ \ / _ \| / __|
	 ___) | | | | |_| | |_| ||  __/  _ <    | | (_) | (_) | \__ \
	|____/|_| |_|\__,_|\__|\__\___|_| \_\   |_|\___/ \___/|_|___/
	-->
	<meta charset="utf-8">
	<title>
		@section('title')
		@show
		 | {{ Config::get('app.appname') }}
	</title>
	<meta content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" name="description">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/animate.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/icon.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/font.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/app.css" rel="stylesheet" type="text/css">
	<link href="/styles.backend.css" rel="stylesheet" type="text/css">
	<!--[if lt IE 9]>
	<script src="/assets/js/ie/html5shiv.js"></script>
	<script src="/assets/js/ie/respond.min.js"></script>
	<script src="/assets/js/ie/excanvas.js"></script>
  	<![endif]-->
</head>

<body class="auth">
	<section class="m-t-lg wrapper-md animated fadeInUp" id="content">
		<div class="container aside-xl">

			<section class="m-b-lg">
				<header class="wrapper text-center h5">
					<strong>@section('title') @show</strong>
				</header>
				<!-- Page Content -->
				@yield('content')
			</section>
		</div>
	</section>
	<script src="/assets/js/jquery.min.js"></script> <!-- Bootstrap -->
	<script src="/assets/js/bootstrap.js"></script> <!-- Bootstrap -->
	<script src="/assets/js/app.js"></script> <!-- App -->
	<script src="/assets/js/slimscroll/jquery.slimscroll.min.js"></script> <!-- Slimscroll -->
	<script src="/assets/js/app.plugin.js"></script> <!-- App plugins -->
</body>
</html>