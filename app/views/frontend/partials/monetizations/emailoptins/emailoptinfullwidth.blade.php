@if($location == 'top')
<div class="bg-primary dk wrapper text-center text-white">
@else
<div class="wrapper text-center">
@endif
	<div class="container">
		<div class="row text-center">
			<div class="col-sm-12 col-md-6 col-md-offset-3">
				@include('frontend.partials.monetizations.emailoptins.emailoptin', ['emailOptin' => OptinForm::find($emailOptinId), 'optinType' => 'fullwidth', 'location' => $location])
			</div>
		</div>
	</div>
</div>