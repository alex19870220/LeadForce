<?php $optinViewPath = 'frontend.partials.monetizations.emailoptins.'; ?>

{{-- Full Width --}}
@if($optinType == 'fullwidth')

	<!-- Form -->
	@include($optinViewPath . 'partials.form')
		<!-- Title -->
		@if(! empty($emailOptin->title))
			<h3 class="h4 m-t-none m-b-sm">
				{{ $emailOptin->title }}
			</h3>
		@endif
		<div class="form-group input-group m-b-none">
			<span class="input-group-addon">
				<label class="fa fa-envelope m-b-none" for="email"></label>
			</span>
			<input type="email" class="form-control" name="email" placeholder="Email address">
			@include($optinViewPath . 'partials.trickbots')
			<div class="input-group-btn">
				<!-- CSRF Token -->
				{{ Form::token() }}
				<!-- FID -->
				<input type="hidden" name="fid" value="{{ $emailOptin->id }}">
				@if($location == 'top')
					@include($optinViewPath . 'partials.submit', ['class' => 'btn-dark'])
				@else
					@include($optinViewPath . 'partials.submit', ['class' => 'btn-primary'])
				@endif
			</div>
		</div>
		@if(! $emailOptin->getOption('hide_privacy'))
		<div class="text-white text-muted m-t-xs">
			@include($optinViewPath . 'privacy')
		</div>
		@endif
	</form>

{{-- Widget --}}
@elseif($optinType == 'widget')

	<!-- Form -->
	@include($optinViewPath . 'partials.form')
		@if(! empty($emailOptin->sub_text))
			<p class="m-b">{{ $emailOptin->sub_text }}</p>
		@endif
		<div class="form-group m-b-xs">
			<label class="control-label sr-only" for="email">Email</label>
			<input type="email" class="form-control" name="email" placeholder="Email address">
		</div>
		<div class="form-group m-b-none">
			<!-- CSRF Token -->
			{{ Form::token() }}
			<!-- FID -->
			<input type="hidden" name="fid" value="{{ $emailOptin->id }}">
			@include($optinViewPath . 'partials.submit', ['class' => 'btn-primary btn-block'])
		</div>
	</form>
	@if(! $emailOptin->getOption('hide_privacy'))
	<div class="text-center">
		<small>
			@include($optinViewPath . 'privacy')
		</small>
	</div>
@endif

{{-- Exit Intent --}}
@elseif($optinType == 'exitintent')

	<div class="m-t-lg">
		<!-- Form -->
		@include($optinViewPath . 'partials.form', ['class' => 'form-inline'])
			@if(! empty($emailOptin->sub_text))
				<div class="h4 m-b-lg">{{ $emailOptin->sub_text }}</div>
			@endif
			<div class="form-group">
				<label class="control-label sr-only" for="email">Email</label>
				<input type="email" class="form-control input-lg" name="email" placeholder="Email address">
			</div>
			<!-- CSRF Token -->
			{{ Form::token() }}
			<!-- FID -->
			<input type="hidden" name="fid" value="{{ $emailOptin->id }}">
			@include($optinViewPath . 'partials.submit', ['class' => 'btn btn-primary btn-lg'])
			@if(! $emailOptin->getOption('hide_privacy'))
			<div class="text-muted text-center m-t-sm">
				@include($optinViewPath . 'privacy')
			</div>
			@endif
		</form>
	</div>

@endif