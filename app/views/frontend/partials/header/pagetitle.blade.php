<h1 class="h2 m-t-none m-b-none">
	@if(trim($__env->yieldContent('title')))
		@section('title')
		@show
	@else
		Page Title
	@endif
</h1>
@if(trim($__env->yieldContent('subtitle')))
	<small class="text-muted">
		@yield('subtitle')
	</small>
@endif