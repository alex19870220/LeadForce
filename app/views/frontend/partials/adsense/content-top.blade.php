@if($adUnit->size == 'default' || $adUnit->size == 'small')
	<div class="pull-left m-r-sm m-b-xs">
		@include('frontend.partials.adsense.adcode')
	</div>
@endif