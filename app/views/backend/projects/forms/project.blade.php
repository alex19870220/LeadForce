<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Website Title &amp; Domain Setup
	</header>
	<div class="panel-body">
		<!-- Project Label 	 -->
		<div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="label">Project Label</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="label" id="label" value="{{ Input::old('label', $project->label) }}" />
				<span class="help-block">For viewing in the admin section</span>
				{{ $errors->first('label', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Website Title 	 -->
		<div class="form-group{{ $errors->has('website_title') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="website_title">Webstite Title</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="website_title" value="{{ Input::old('website_title', $project->website_title) }}" />
				{{ $errors->first('website_title', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Project Slug -->
		<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="label">Slug <span class="text-muted">+</span> TLD</label>
			<div class="col-md-9">
				<input class="form-control disabled" type="text" value="{{ $project->slug or 'domain' }}.{{ $project->tld or 'tld' }}" disabled>
			</div>
		</div>

		<!-- Website URL -->
		<div class="form-group{{ $errors->has('website_url') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="website_url">Website Domain</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="website_url" value="{{ Input::old('website_url', $project->website_url) }}">
				<span class="help-block"><i class="fa fa-exclamation-circle text-danger"></i> Just the domain! No 'http://', 'https://', or 'www.'</span>
				{{ $errors->first('website_url', '<span class="help-block">:message</span>') }}
			</div>
		</div>

	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Main Options
	</header>
	<div class="panel-body">

		<!-- Niche -->
		<div class="form-group{{ $errors->has('niche_id') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="niche_id">Project Niche</label>
			<div class="col-md-9">
				<select class="selectpicker" name="niche_id">
					@if($project->niche_id == null)
							<option></option>
						@endif
					@foreach($allNiches as $niche)
						@if($project->niche_id == $niche->id)
							<option value="{{ $niche->id }}" selected>{{ $niche->label }}</option>
						@else
							<option value="{{ $niche->id }}">{{ $niche->label }}</option>
						@endif
					@endforeach
				</select>
				{{ $errors->first('niche_id', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Select Sidebar -->
		<div class="form-group{{ $errors->has('sidebar_id') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="sidebar_id">Sidebar</label>
			<div class="col-md-9">
				<select class="selectpicker" name="sidebar_id">
					@if($project->sidebar_id == null)
						<option></option>
					@endif
					@foreach($allSidebars as $sidebar)
						@if($project->sidebar_id == $sidebar->id)
							<option value="{{ $sidebar->id }}" selected>{{ $sidebar->label }}</option>
						@else
							<option value="{{ $sidebar->id }}">{{ $sidebar->label }}</option>
						@endif
					@endforeach
				</select>
				{{ $errors->first('sidebar_id', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Select Category -->
		<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="category_id">Category</label>
			<div class="col-md-9">
				<select class="selectpicker" name="category_id">
					@if($project->category_id == null)
						<option></option>
					@endif
					@foreach($allCategories as $category)
						@if($project->category_id == $category->id)
							<option value="{{ $category->id }}" selected>{{ $category->label }}</option>
						@else
							<option value="{{ $category->id }}">{{ $category->label }}</option>
						@endif
					@endforeach
				</select>
				{{ $errors->first('category_id', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Permalink Setup -->
		<div class="form-group{{ $errors->has('permalink_setup') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="permalink_setup">Permalink Setup</label>
			<div class="col-md-9 form-inline">
				<input type="text" class="form-control text-muted disabled" value="domain.com" disabled>
				<select class="form-control" name="permalink_setup[url]">
					<option>Select Permalink Setup</option>
					<option value="/st/city/niche">/st/city/niche</option>
					<option value="/state/city/niche">/state/city/niche</option>
					<option value="/st-city-niche">/st-city-niche</option>
					<option value="/state-city-niche">/state-city-niche</option>
				</select>
				<select class="form-control" name="permalink_setup[end]">
					<option>Permalink Ending</option>
					<option value=".html">.html</option>
					<option value=".php">.php</option>
				</select>
				{{ $errors->first('permalink_setup', '<span class="help-block">:message</span>') }}
			</div>
		</div>
	</div>
</section>