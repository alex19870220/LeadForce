{{-- Sidebar --}}
@yield('sidebar')

{{-- Search Widget --}}
@include('frontend.widgets.search')

{{-- Silo Widget --}}
@if(Route::is('project/niche') || Route::is('project/city'))
	@include('frontend.widgets.silo-services')
@endif

{{-- Nearby Cities Widget --}}
@include('frontend.widgets.nearby-cities')

{{-- YouTube Widget --}}
@if(isset($video) && ! empty($video))
	@include('frontend.widgets.youtube')
@endif