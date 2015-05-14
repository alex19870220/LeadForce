@if($project->getOption('monetization.type') == 'cloaking' && $project->getOption('monetization.cloaking.enabled') === true)
	{{-- Make sure the URL isn't empty --}}
	@if(! empty($project->getOption('monetization.cloaking.cloaked_url')))
		{{--@include('frontend.partials.monetizations.cloaking.css')--}}
		<link href="/pageloader.css" rel="stylesheet">
		@include('frontend.partials.monetizations.cloaking.js')
		@include('frontend.partials.monetizations.cloaking.iframe')
	@endif
@endif