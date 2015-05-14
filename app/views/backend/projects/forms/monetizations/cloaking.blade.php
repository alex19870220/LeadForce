<h4 class="page-header m-t-none">Cloaking Options</h4>

<!-- Enable Cloaking -->
{{ HTML::optionSwitch('options[monetization.cloaking.enabled]', 'Enable Cloaking', $project->getOption('monetization.cloaking.enabled')) }}

<!-- Cloaked URL -->
<div class="form-group">
	<label class="col-md-3 control-label">Cloaked URL (use this)</label>
	<div class="col-md-9">
		<input type="text" class="form-control" name="options[monetization.cloaking.cloaked_url]" placeholder="http://www.google.com" value="{{ $project->getOption('monetization.cloaking.cloaked_url') }}">
		 <!-- placeholder="http://www.google.com" -->
	</div>
</div>

<!-- URL Type -->
{{ HTML::optionRadio('options[monetization.cloaking.url_type]', [
	'custom|Custom URL|data-radio-changer data-show-div="cloaking_custom_url"',
	'homeadvisor_redirect|HomeAdvisor Redirect|data-radio-changer data-show-div="cloaking_homeadvisor_redirect"',
	], 'Cloaked URL Type', $project->getOption('monetization.cloaking.url_type')) }}

<!-- Cloaking URL - Custom URL -->
<div id="cloaking_custom_url" class="form-group">
	<label class="col-md-3 control-label">Custom Cloaked URL</label>
	<div class="col-md-9">
		<input type="text" class="form-control" name="options[monetization.cloaking.url.custom_url]" placeholder="http://www.google.com" value="{{ $project->getOption('monetization.cloaking.cloaked_url') }}">
		<span class="help-block"><i class="fa fa-exclamation-circle text-danger"></i> We're switching to this one, just ignore it for now</span>
	</div>
</div>

<!-- Cloaking URL - HomeAdvisor Redirect URL -->
<div id="cloaking_homeadvisor_redirect" class="form-group">
	<label class="col-md-3 control-label">HomeAdvisor Redirect URL</label>
	<div class="col-md-9">
		<select class="selectpicker" name="options[monetization.cloaking.url.homeadvisor_redirect]" />
			<!-- value="{{ $project->getOption('monetization.cloaking.url.homeadvisor_redirect') }}" -->
			<option value=""></option>
			<option value="1">Test 1</option>
			<option value="2">Test 2</option>
			<option value="3">Test 3</option>
			<option value="4">Test 4</option>
			<option value="5">Test 5</option>
			<option value="6">Test 6</option>
		</select>
	</div>
</div>

<!-- Cloaked Routes -->
{{ HTML::optionRadio('options[monetization.cloaking.cloak_all_pages]', [
	'1|Enabled|data-radio-changer',
	'0|Disabled|data-radio-changer data-show-div="no_cloak_routes"',
	], 'Cloak All Pages', $project->getOption('monetization.cloaking.cloak_all_pages')) }}

<!-- Cloak All Pages -->
@include('backend.projects.forms.monetizations.partials-cloaking.cloakbyroutes')

<h4 class="page-header m-t-none">Cloaking by Niche</h4>

<!-- Cloak by Niche -->
{{ HTML::optionRadio('options[monetization.cloaking.cloak_by_niche]', [
	'1|Enabled|data-radio-changer data-show-div="cloak_by_niche"',
	'0|Disabled|data-radio-changer',
	], 'Cloak by Niche', $project->getOption('monetization.cloaking.cloak_by_niche'), 'Save Project before filling out Niche URLs!') }}

<!-- Cloak by Niche URL's -->
<div id="cloak_by_niche">
	@if($project->niche !== null)
		<!-- Parent Niche -->
		@include('backend.projects.forms.monetizations.partials-cloaking.cloakbyniche', ['project' => $project, 'niche' => $project->niche])

		@if($project->niche->children !== null)
			<!-- Child Niches -->
			@foreach($project->niche->children as $childNiche)
				@include('backend.projects.forms.monetizations.partials-cloaking.cloakbyniche', ['project' => $project, 'niche' => $childNiche])
			@endforeach
		@else
			<div class="col-md-offset-3 col-md-9">
				<div class="alert alert-danger">
					<p><i class="fa fa-exclamation-circle"></i> Project's Niche has no sub-Niches!</p>
				</div>
			</div>
		@endif
	@else
		<div class="col-md-offset-3 col-md-9">
			<div class="alert alert-danger">
				<p><i class="fa fa-exclamation-circle"></i> Project has no Niche!</p>
			</div>
		</div>
	@endif
</div>