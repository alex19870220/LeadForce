<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Default
		<span class="label label-info pull-right">Optional</span>
	</header>
	<div class="panel-body">
		<!-- Meta Title -->
		<div class="form-group ">
			<label class="control-label col-md-3" for="meta[default][title]">Meta Title</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="meta[default][title]" value="{{ Input::old('meta[default][title]', $niche->getMetaTitle('default')) }}" maxlength="60">
				<span class="help-block">Google's max: 60 chars</span>
			</div>
		</div>
		<!-- Meta Description -->
		<div class="form-group ">
			<label class="control-label col-md-3" for="meta[default][description]">Meta Description</label>
			<div class="col-md-9">
				<textarea class="form-control" name="meta[default][description]" rows="3" maxlength="160">{{ Input::old('meta[default][description]', $niche->getMetaDescription('default')) }}</textarea>
				<span class="help-block">Google's max: 160 chars</span>
			</div>
		</div>
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		State Pages
		<span class="label label-info pull-right">Optional</span>
	</header>
	<div class="panel-body">
		<!-- Meta Title -->
		<div class="form-group ">
			<label class="control-label col-md-3" for="meta[state][title]">Meta Title</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="meta[state][title]" value="{{ Input::old('meta[state][title]', $niche->getMetaTitle('state')) }}" maxlength="60">
				<span class="help-block">Google's max: 60 chars</span>
			</div>
		</div>
		<!-- Meta Description -->
		<div class="form-group ">
			<label class="control-label col-md-3" for="meta[state][description]">Meta Description</label>
			<div class="col-md-9">
				<textarea class="form-control" name="meta[state][description]" rows="3" maxlength="160">{{ Input::old('meta[state][description]', $niche->getMetaDescription('state')) }}</textarea>
				<span class="help-block">Google's max: 160 chars</span>
			</div>
		</div>
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		City Pages
		<span class="label label-info pull-right">Optional</span>
	</header>
	<div class="panel-body">
		<!-- Meta Title -->
		<div class="form-group ">
			<label class="control-label col-md-3" for="meta[city][title]">Meta Title</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="meta[city][title]" value="{{ Input::old('meta[city][title]', $niche->getMetaTitle('city')) }}" maxlength="60">
				<span class="help-block">Google's max: 60 chars</span>
			</div>
		</div>
		<!-- Meta Description -->
		<div class="form-group ">
			<label class="control-label col-md-3" for="meta[city][description]">Meta Description</label>
			<div class="col-md-9">
				<textarea class="form-control" name="meta[city][description]" rows="3" maxlength="160">{{ Input::old('meta[city][description]', $niche->getMetaDescription('city')) }}</textarea>
				<span class="help-block">Google's max: 160 chars</span>
			</div>
		</div>
	</div>
</section>