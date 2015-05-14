{{-- Sidebar --}}
@yield('sidebar')

{{-- Search Widget --}}
@include('frontend.widgets.search')

{{-- Social Widget --}}
@include('frontend.widgets.social')

{{-- Silo Widget --}}
@if(Route::is('project/niche') || Route::is('project/city'))
	@include('frontend.widgets.silo_services')
@endif

{{-- YouTube Widget --}}
@if(isset($video) && strlen($video) > 4)
	@include('frontend.widgets.youtube')
@endif