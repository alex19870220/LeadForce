{{-- Content --}}
@yield('content_full')
{{-- Footer Ad --}}
@if($project->getOption('monetization.adsense.footer.enabled') === true)
	{{ AdsenseHelper::getFooterAd() }}
@endif