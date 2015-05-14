<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Sidebar Options
	</header>
	<div class="panel-body">
		<!-- Niche Sub-Services -->
		<div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
			<label for="services">Monetization Type</label>
			<div class="radio i-checks">
				<label><input name="sidebar_monetize" type="radio" checked="checked"><i></i> None</label> </div>
			<div class="radio i-checks">
				<label><input name="sidebar_monetize" type="radio"><i></i> Email Optin</label>
			</div>
			<div class="radio i-checks">
				<label><input name="sidebar_monetize" type="radio"><i></i> Lead Form</label>
			</div>
			<div class="radio i-checks">
				<label><input name="sidebar_monetize" type="radio"><i></i> Advertisement</label>
			</div>
			<div class="radio i-checks">
				<label><input name="sidebar_monetize" type="radio"><i></i> Custom</label>
			</div>
		</div>
	</div>
</section>