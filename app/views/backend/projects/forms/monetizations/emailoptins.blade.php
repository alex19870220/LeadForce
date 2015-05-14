<h4 class="page-header m-t-none">Email Provider Settings</h4>

<!-- Email Service Provider -->
{{ HTML::optionRadio('options[monetization.email_optin.provider]', [
	"aweber|AWeber",
	"icontact|iContact",
	"mailchimp|MailChimp",
	"|None",
	], 'Email Service Provider', $project->getOption('monetization.email_optin.provider')) }}

<!-- Mailchimp API Key -->
<div class="form-group">
	<label class="col-md-3 control-label" for="options[monetization.email_optin.mailchimp.api_key]">MailChimp API Key</label>
	<div class="col-md-9">
		<input type="text" class="form-control" name="options[monetization.email_optin.mailchimp.api_key]" value="{{ $project->getOption('monetization.email_optin.mailchimp.api_key') }}" maxlength="36">
	</div>
</div>

<!-- Mailchimp List ID -->
<div class="form-group">
	<label class="col-md-3 control-label" for="options[monetization.email_optin.mailchimp.list]">MailChimp List ID</label>
	<div class="col-md-9">
		<input type="text" class="form-control" name="options[monetization.email_optin.mailchimp.list]" value="{{ $project->getOption('monetization.email_optin.mailchimp.list') }}" maxlength="10">
	</div>
</div>

<h4 class="page-header">Exit Intent Popup</h4>

<!-- Enable Exit Intent -->
{{ HTML::optionSwitch('options[monetization.email_optin.design.exit_intent.enabled]', 'Exit-Intent Popup', $project->getOption('monetization.email_optin.design.exit_intent.enabled')) }}

<!-- Exit Intent Form -->
@include('backend.projects.partials.emailoptin_select', ['label' => 'Exit Intent Form', 'option' => 'monetization.email_optin.design.exit_intent.form_id'])

<h4 class="page-header">Top Email Optin</h4>

<!-- Enable Top Optin -->
{{ HTML::optionSwitch('options[monetization.email_optin.design.optin_top.enabled]', 'Top Email Optin Box', $project->getOption('monetization.email_optin.design.optin_top.enabled')) }}

<!-- Top Optin Form -->
@include('backend.projects.partials.emailoptin_select', ['label' => 'Top Form', 'option' => 'monetization.email_optin.design.optin_top.form_id'])

<h4 class="page-header">Bottom Email Optin</h4>

<!-- Enable Bottom Optin -->
{{ HTML::optionSwitch('options[monetization.email_optin.design.optin_bottom.enabled]', 'Bottom Email Optin Box', $project->getOption('monetization.email_optin.design.optin_bottom.enabled')) }}

<!-- Bottom Optin Form -->
@include('backend.projects.partials.emailoptin_select', ['label' => 'Bottom Form', 'option' => 'monetization.email_optin.design.optin_bottom.form_id'])