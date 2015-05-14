@if(isset($adUnit))
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- {{ $adUnit->width }}x{{ $adUnit->height }} -->
	<ins class="adsbygoogle"
		style="display:inline-block;width:{{ $adUnit->width }}px;height:{{ $adUnit->height }}px"
		data-ad-client="{{ AdsenseHelper::getPublisherId() }}"
		data-ad-slot="{{ $adUnit->adUnitId }}"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
@endif