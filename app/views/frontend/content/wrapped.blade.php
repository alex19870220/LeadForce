<div class="bg-white b-b b-light">
	<div id="content-container" class="container">
		<div class="row">
			<div class="col-lg-12">
				{{-- Top Content Ad --}}
				@if(! in_array(Route::currentRouteName(), ['browse/states', 'project/state', 'project/state/letter']))
					@if($project->getOption('monetization.adsense.top_content.enabled') === true)
						{{ AdsenseHelper::getTopContentAd() }}
					@endif
				@endif
				{{-- Content --}}
				@yield('content_wrapped')
			</div>
		</div>
	</div>
</div>
{{-- Footer Ad --}}
@if($project->getOption('monetization.adsense.footer.enabled') === true)
	{{ AdsenseHelper::getFooterAd() }}
@endif