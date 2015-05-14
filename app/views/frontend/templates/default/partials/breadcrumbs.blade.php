<div class="bg-white b-b b-light">
	<div class="container">
		@if(!trim($__env->yieldContent('breadcrumbs')))
			{{ Breadcrumbs::renderIfExists() }}
		@else
			@yield('breadcrumbs')
		@endif
	</div>
</div>