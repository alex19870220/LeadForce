<!-- Page Title &amp; Widets -->
<section class="row m-b-md b-b b-light">
	<div class="col-sm-6 m-b-sm">
		<h3 class="m-b-xs text-black">
			@if(trim($__env->yieldContent('title')))
				@section('title')
				@show
			@else
				{{ Config::get('app.appname') }}
			@endif
		</h3>
	</div>
	<!-- Widgets -->
	<div class="col-sm-6 text-right text-left-xs m-t-md m-b-sm">
		@if(trim($__env->yieldContent('buttons')))
			@yield('buttons')
		@else
			<a href="#nav, #sidebar" class="btn btn-icon b-2x btn-info btn-rounded" data-toggle="class:nav-xs, show"><i class="fa fa-bars"></i></a>
		@endif
	</div>
</section>