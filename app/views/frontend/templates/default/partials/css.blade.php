<link href="{{ $project->present()->templateDirectory() }}/assets/css/styles.css" rel="stylesheet">
{{-- Don't load scripts when cloaking --}}
@if($project->getOption('monetization.cloaking.enabled') !== true || $project->getOption('monetization.type') !== 'cloaking')
	<link href="/assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="/assets/css/icon.css" rel="stylesheet">
	<link href="{{ $project->present()->templateDirectory() }}/assets/css/font.css" rel="stylesheet">
@endif

	<link href="{{ $project->present()->templateDirectory() }}/assets/css/landing.css" rel="stylesheet">
	<link href="{{ $project->present()->templateDirectory() }}/styles.css" rel="stylesheet">