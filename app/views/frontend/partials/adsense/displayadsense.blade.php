@if($project->getOption('monetization.adsense.enabled') === true && isset($adUnit))
	@if($adUnit->location == 'top-content')
		@include('frontend.partials.adsense.content-top', ['adUnit' => $adUnit])
	@elseif($adUnit->location == 'footer')
		@include('frontend.partials.adsense.footer', ['adUnit' => $adUnit])
	@endif
@endif