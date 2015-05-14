@if($project->getOption('design.header.header_sticky') === true && $project->getOption('monetization.type') !== 'cloaking')
<header class="navbar navbar-fixed-top bg-white box-shadow b-b b-light" data-offset-top="1" data-spy="affix" id="header">
@else
<header id="header" class="navbar bg-white box-shadow b-b b-light">
@endif
	{{-- Header --}}
	<div class="container">
		<div class="navbar-header">
			<a href="{{ $project->present()->homeUrl }}" class="navbar-brand">
				<img src="{{ $project->present()->templateDirectory() }}/images/logo.png" class="m-r-sm">
				<span class="text-muted">{{ $project->website_title }}</span>
			</a>
			<button class="btn btn-link visible-xs" type="button" data-toggle="collapse" data-target=".navbar-collapse"> <i class="fa fa-bars"></i> </button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right" id="frontend-nav">
				@include('frontend.templates.default.navigation')
			</ul>
		</div>
	</div>
</header>