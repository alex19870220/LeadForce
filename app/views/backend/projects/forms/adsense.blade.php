<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Adsense Advertising
	</header>
	<div class="panel-body">
		<!-- Enable Adsense -->
		{{ HTML::optionSwitch('options[monetization.adsense.enabled]', 'Enable Adsense', $project->getOption('monetization.adsense.enabled')) }}

		<!-- Ad Group -->
		<div class="form-group">
			<label class="col-md-3 control-label">Ad Group</label>
			<div class="col-md-9">
				<select class="form-control" name="options[monetization.adsense.adsense_id]">
					@foreach($adsenseGroups as $adsenseGroup)
						@if($project->getOption('monetization.adsense.adsense_id') == $adsenseGroup->id)
							<option value="{{ $adsenseGroup->id }}" selected>{{ $adsenseGroup->label }}</option>
						@else
							<option value="{{ $adsenseGroup->id }}">{{ $adsenseGroup->label }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>

		<!-- Header Ads -->
		<h4 class="page-header">Header Ads</h4>
		<!-- Header Enabled -->
		{{ HTML::optionSwitch('options[monetization.adsense.header.enabled]', 'Enabled', $project->getOption('monetization.adsense.header.enabled')) }}
		<!-- Header Size -->
		{{ HTML::optionRadio('options[monetization.adsense.header.size]', [
			"small|Small",
			"default|Default",
			"large|Large",
			], 'Ad Size', $project->getOption('monetization.adsense.header.size')) }}

		<!-- Top Content Ads -->
		<h4 class="page-header">Top Content Ads</h4>
		<!-- Top Content Enabled -->
		{{ HTML::optionSwitch('options[monetization.adsense.top_content.enabled]', 'Enabled', $project->getOption('monetization.adsense.top_content.enabled')) }}
		<!-- Top Content Size -->
		{{ HTML::optionRadio('options[monetization.adsense.top_content.size]', [
			"small|Small",
			"default|Default",
			"large|Large",
			], 'Ad Size', $project->getOption('monetization.adsense.top_content.size')) }}

		<!-- Content Ads -->
		<h4 class="page-header">Content Ads</h4>
		<!-- Content Enabled -->
		{{ HTML::optionSwitch('options[monetization.adsense.content.enabled]', 'Enabled', $project->getOption('monetization.adsense.content.enabled')) }}
		<!-- Content Size -->
		{{ HTML::optionRadio('options[monetization.adsense.content.size]', [
			"small|Small",
			"default|Default",
			"large|Large",
			], 'Ad Size', $project->getOption('monetization.adsense.content.size')) }}
		<!-- Content Ad Count -->
		<div class="form-group">
			<label class="col-md-3 control-label">Ad Count</label>
			<div class="col-md-9">
				<input type="number" name="options[monetization.adsense.content.number_ads]" class="form-control" min="1" max="3" value="{{ $project->getOption('monetization.adsense.content.number_ads') }}">
			</div>
		</div>

		<!-- Footer Ads -->
		<h4 class="page-header">Footer Ads</h4>
		<!-- Footer Enabled -->
		{{ HTML::optionSwitch('options[monetization.adsense.footer.enabled]', 'Enabled', $project->getOption('monetization.adsense.footer.enabled')) }}
		<!-- Footer Size -->
		{{ HTML::optionRadio('options[monetization.adsense.footer.size]', [
			"small|Small",
			"default|Default",
			"large|Large",
			], 'Ad Size', $project->getOption('monetization.adsense.footer.size')) }}

	</div>
</section>