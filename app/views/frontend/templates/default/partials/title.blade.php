<!-- Page Title & Subtitle -->
<div class="bg-dark">
	<div class="container wrapper">
		<div class="pull-left">
			@include('frontend.partials.header.pagetitle')
		</div>
		@if($project->getOption('monetization.adsense.header.enabled') !== false)
			<div class="pull-right">
				{{ AdsenseHelper::getHeaderAd() }}
			</div>
		@endif
	</div>
</div>