<section class="panel panel-primary">
	<header class="panel-heading">
		Page Options
	</header>
	<section class="panel-body">

		<!-- Display Login/Register -->
		<div class="form-group {{ $errors->has('opt_show_user_menu') ? 'has-error' : '' }}">
			<label for="opt_show_user_menu">Show User Login &amp; Register</label>
			<!-- radio -->
		</div>
		{{ $errors->first('opt_show_user_menu', '<span class="help-block">:message</span>') }}

	</section>
</section>

<section class="panel panel-primary">
	<header class="panel-heading">
		SEO Options
	</header>
	<section class="panel-body">

	</section>
</section>