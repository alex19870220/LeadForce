<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Monetization Options
	</header>
	<div class="panel-body">
		<!-- Monetization Type -->
		{{ HTML::optionRadio('options[monetization.type]', [
			'affiliateoffer|Affiliate Offer|data-radio-changer data-show-div="affiliateoffer"',
			'cloaking|Cloaking|data-radio-changer data-show-div="cloaking"',
			'emailoptin|Email Optin|data-radio-changer data-show-div="emailoptin"',
			'leadgen|Lead Gen|data-radio-changer data-show-div="leadgen"',
			'|None|data-radio-changer',
			], 'Main Monetization', $project->getOption('monetization.type')) }}
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Monetization Specific Settings
	</header>
	<div class="panel-body">
			<!-- Affiliate Offers -->
			<div class="changer-field" id="affiliateoffer">
				@include('backend.projects.forms.monetizations.affiliateoffers')
			</div>

			<!-- Cloaking -->
			<div class="changer-field" id="cloaking">
				@include('backend.projects.forms.monetizations.cloaking')
			</div>

			<!-- Email Optins -->
			<div class="changer-field" id="emailoptin">
				@include('backend.projects.forms.monetizations.emailoptins')
			</div>

			<!-- Leadgen -->
			<div class="changer-field" id="leadgen">
				@include('backend.projects.forms.monetizations.leadgen')
			</div>
	</div>
</section>