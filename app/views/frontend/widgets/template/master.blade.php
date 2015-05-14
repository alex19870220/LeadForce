@if(! empty(trim($__env->yieldContent('widget_body'))))
<div class="widget">
	@if(trim($__env->yieldContent('widget_title')))
		<h5 class="widget-title font-semibold">{{ trim($__env->yieldContent('widget_title')) }}</h5>
		<div class="line line-dashed"></div>
	@endif
	<div class="widget-body">
		@yield('widget_body')
	</div>
</div>
@endif