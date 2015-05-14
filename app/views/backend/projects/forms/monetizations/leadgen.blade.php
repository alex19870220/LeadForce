<h4 class="page-header m-t-none">Lead Gen Options</h4>

<!-- iFrame iFrame Type -->
{{ HTML::optionRadio('options[monetization.leadgen.iframe_type]', [
	'custom|Custom iFrame|data-radio-changer data-show-div="leadgen_custom_iframe"',
	'homeadvisor_iframe|HomeAdvisor iFrame|data-radio-changer data-show-div="leadgen_homeadvisor_iframe"',
	'quinnstreet|QuinnStreet iFrame|data-radio-changer data-show-div="leadgen_quinnstreet_redirect"',
	], 'iFrame Type', $project->getOption('monetization.leadgen.iframe_type')) }}
	
<!-- Cloaking iFrame - Custom iFrame -->
<div id="leadgen_custom_iframe" class="form-group">
	<label class="col-md-3 control-label">Custom Leadgen iFrame</label>
	<div class="col-md-9">
		<input type="text" class="form-control" name="options[monetization.leadgen.iframe.custom_iframe]" value="{{ $project->getOption('monetization.leadgen.iframe.custom_iframe') }}">
	</div>
</div>

<!-- Cloaking iFrame - HomeAdvisor iFrame iFrame -->
<div id="leadgen_homeadvisor_iframe" class="form-group">
	<label class="col-md-3 control-label">HomeAdvisor iFrame</label>
	<div class="col-md-9">
		<select class="selectpicker" name="options[monetization.leadgen.iframe.homeadvisor_iframe]" />
			<!-- value="{{ $project->getOption('monetization.leadgen.iframe.homeadvisor_iframe') }}" -->
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

<!-- Cloaking iFrame - HomeAdvisor iFrame iFrame -->
<div id="leadgen_quinnstreet_redirect" class="form-group">
	<label class="col-md-3 control-label">QuinnStreet iFrame</label>
	<div class="col-md-9">
		<select class="selectpicker" name="options[monetization.leadgen.iframe.homeadvisor_iframe]" />
			<!-- value="{{ $project->getOption('monetization.leadgen.iframe.homeadvisor_iframe') }}" -->
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