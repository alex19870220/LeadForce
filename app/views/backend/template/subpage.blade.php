<form method="post" action="" autocomplete="off" enctype="multipart/form-data">

	<!-- CSRF Token -->
	{{ Form::token() }}

	<div class="row">
		<!-- Left Column -->
		<div class="col-md-9">
			@yield('submenu_content')
		</div> <!-- End Left Column -->

		<!-- Right Column -->
		<div class="col-md-3">
			@yield('submenu_right')
		</div> <!-- End Right Column -->
	</div>
</form>