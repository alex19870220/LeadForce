

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Project Options
	</header>
	<div class="panel-body">
		<!-- Display Login/Register -->
		{{ HTML::optionSwitch('options[show_user_menu]', 'Show User Login &amp; Register', $project->getOption('show_user_menu')) }}
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		SEO Options
	</header>
	<div class="panel-body">
		<!-- Silo Style -->
		{{ HTML::optionRadio('options[silo_style]', [
			"show_states|List All States",
			"show_cities|List Cities in Same County",
			], 'Sidebar Silo Style', $project->getOption('silo_style')) }}

		<div class="form-group">
			<label class="control-label col-md-3" for="options[seo.misc.separator]">Title Separator</label>
			<div class="col-md-2">
				<input type="text" class="form-control" name="options[seo.misc.separator]" value="{{ Input::old('options[seo.misc.separator]', $project->getOption('seo.misc.separator')) }}" />
			</div>
		</div>
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Content &amp; Cache Options
	</header>
	<div class="panel-body">
		<!-- Process Content in Chunks -->
		{{ HTML::optionSwitch('options[process_content_chunks]', 'Process Content in Chunks', $project->getOption('process_content_chunks')) }}
		<div class="form-group">
			<div class="col-md-offset-3 col-md-9">
				<span class="help-block">This is experimental, use with caution!</span>
			</div>
		</div>
	</div>
</section>