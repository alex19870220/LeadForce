<!-- OuiBounce Modal -->
<div id="ouibounce-modal">
	<div class="underlay"></div>
	<div class="modal">
		<div class="ouibounce-modal-content">
			<div class="ouibounce-modal-title">
				<h3>{{ $emailOptin->title }}</h3>
			</div>
			<div class="ouibounce-modal-body">
				@include('frontend.partials.monetizations.emailoptins.emailoptin', ['emailOptinId' => $project->getOption('monetization.email_optin.design.exit_intent.form_id'), 'optinType' => 'exitintent'])
			</div>
			<div class="ouibounce-modal-footer text-muted">
				<p>no thanks</p>
			</div>
		</div>
	</div>
</div>