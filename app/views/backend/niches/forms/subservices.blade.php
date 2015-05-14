<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Child Niches &amp; Services
	</header>
	<div class="panel-body">
		<!-- Niche Sub-Services -->
		<div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
			<label for="services">Add New</label>
			@if(Route::currentRouteName() == 'edit/niche')
				<textarea class="form-control" name="services" id="services" rows="5" placeholder="One per line">{{ Input::old('services') }}</textarea>
			@elseif(Route::currentRouteName() == 'create/niche')
				<textarea class="form-control" name="services" id="services" rows="5" placeholder="One per line">{{ Input::old('services') }}</textarea>
			@endif
			{{ $errors->first('services', '<span class="help-block">:message</span>') }}
			<span class="help-block">E.G. wedding photography, fashion photography, family portraits, etc</span>
		</div>
	</div>
</section>