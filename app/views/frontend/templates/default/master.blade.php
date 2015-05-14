<!DOCTYPE html>
<!-- HTML5 Boilerplate -->
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	@include('frontend.partials.header.meta-seo')

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@include('frontend.partials.header.javascripts')

	@include('frontend.templates.default.partials.css')

	<link rel="icon" type="image/png" href="{{ $project->present()->templateDirectory() }}/favicon.png" />
	<link rel="shortcut icon" href="{{ $project->present()->templateDirectory() }}/favicon.png">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="assets/css/ie8.css">
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
	<![endif]-->
	@include('frontend.partials.header.meta')

	{{-- Cloaking --}}
	@include('frontend.partials.monetizations.cloaking.cloaking')
</head>
<body>
	{{-- Header --}}
	@include('frontend.templates.default.header')

	<section id="content">
		{{-- Lander --}}
		@if(Route::is('project/home'))
			@include('frontend.partials.landers.lander')
		@endif

		{{-- Page Title --}}
		@if(Route::currentRouteName() !== 'project/home')
			@include('frontend.templates.default.partials.title')
		@endif

		{{-- Breadcrumbs --}}
		@if($project->getOption('design.header.breadcrumbs_show') === true)
			@if(! Route::is('project/home'))
				@include('frontend.templates.default.partials.breadcrumbs')
			@endif
		@endif

		{{-- Email Optin - Top --}}
		@if($project->getOption('monetization.type') == 'emailoptin')
			@if($project->getOption('monetization.email_optin.design.optin_top.enabled') !== false && Route::currentRouteName() !== 'project/home')
				@if($topOptinId = $project->getOption('monetization.email_optin.design.optin_top.form_id')) @endif
				@if(! empty($topOptinId))
					@include('frontend.partials.monetizations.emailoptins.emailoptinfullwidth', ['emailOptinId' => $topOptinId, 'location' => 'top'])
				@endif
			@endif
		@endif

		{{-- Page Content --}}
		@include('frontend.templates.default.content')
	</section>

	{{-- Email Optin - Bottom --}}
	@if($project->getOption('monetization.type') == 'emailoptin')
		@if($project->getOption('monetization.email_optin.design.optin_bottom.enabled') !== false && Route::currentRouteName() !== 'project/home')
			@if($bottomOptinId = $project->getOption('monetization.email_optin.design.optin_bottom.form_id')) @endif
			@if(! empty($bottomOptinId))
				@include('frontend.partials.monetizations.emailoptins.emailoptinfullwidth', ['emailOptinId' => $bottomOptinId, 'location' => 'bottom'])
			@endif
		@endif
	@endif

	{{-- Footer --}}
	@include('frontend.templates.default.footer')

	{{-- Include Modals --}}
	@include('frontend.partials.modals.modal_master')

	{{-- Scripts --}}
	@include('frontend.partials.footer.javascripts')

	@if($project->tracking_id !== '')
		@include('frontend.partials.footer.piwik')
	@endif
</body>
</html>