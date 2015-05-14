@if($project->getOption('monetization.type') == 'emailoptin' && $project->getOption('monetization.email_optin.design.exit_intent.enabled') === true)
	@if($exitIntentOptinId = $project->getOption('monetization.email_optin.design.exit_intent.form_id')) @endif
	@if(! empty($exitIntentOptinId))
		@include('frontend.partials.monetizations.emailoptins.ouibounce', ['emailOptin' => OptinForm::find($exitIntentOptinId)])
	@endif
@endif