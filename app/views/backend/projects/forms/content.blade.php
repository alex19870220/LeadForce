<!-- Home Page Content -->
<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Home Page
	</header>
	<div class="panel-body">
		<!-- Home Headline -->
		<div class="form-group">
			<label class="col-md-3 control-label">Home Headline</label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="options[design.home.headline]" value="{{ e($project->getOption('design.home.headline')) }}">
			</div>
		</div>

		<!-- Sub Headline -->
		<div class="form-group">
			<label class="col-md-3 control-label">Sub Headline</label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="options[design.home.subheadline]" value="{{ e($project->getOption('design.home.subheadline')) }}">
			</div>
		</div>

		<!-- Enable Home Page Monetizing -->
		{{ HTML::optionSwitch('options[design.home.show_monetization]', 'Show Monetization', $project->getOption('design.home.show_monetization')) }}
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		State Content
		<span class="label label-default bg-light pull-right">Optional</span>
	</header>
	<!-- Page Excerpt -->
	<div class="block {{ $errors->has('content[state]') ? 'has-error' : '' }}">
		<label for="about" class="sr-only">State Content</label>
		<textarea class="form-control ckeditor" name="content[state]" rows="5">{{ Input::old('content[state]', $project->getContent('state')) }}</textarea>
		{{ $errors->first('content[state]', '<span class="help-block">:message</span>') }}
		<span class="help-block">Shortcodes available: <code>[state]</code> <code>[st]</code> <code>[mkw]</code> <code>[ckw]</code></span>
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		About Us
		<span class="label label-default bg-light pull-right">Optional</span>
	</header>
	<!-- Page Excerpt -->
	<div class="block {{ $errors->has('about') ? 'has-error' : '' }}">
		<label for="about" class="sr-only">About Us</label>
		<textarea class="form-control ckeditor" name="about" rows="5">{{ Input::old('about', $project->about) }}</textarea>
		{{ $errors->first('about', '<span class="help-block">:message</span>') }}
		<!-- <span class="help-block">E.G. wedding photography, fashion photography, family portraits, etc</span> -->
	</div>
</section>