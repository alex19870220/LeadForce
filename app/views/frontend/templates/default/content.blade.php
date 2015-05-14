{{-- Content With Sidebar --}}
@if(trim($__env->yieldContent('content')))
	@include('frontend.content.wrapped-sidebar')
{{-- Full Width Content --}}
@elseif(trim($__env->yieldContent('content_full')))
	@include('frontend.content.fullwidth')
{{-- Wrapped Content --}}
@elseif(trim($__env->yieldContent('content_wrapped')))
	@include('frontend.content.wrapped')
@endif