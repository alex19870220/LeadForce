<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Main Niche Data
	</header>
	<div class="panel-body">

		<!-- Niche Label 	 -->
		<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
			<label class="control-label col-md-3" for="label">Niche Label</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="label" id="label" value="{{ Input::old('label', $niche->label) }}" />
				{{ $errors->first('label', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Niche Parent -->
		<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
			<label class="control-label col-md-3" for="parent_id">Niche Parent</label>
			<div class="col-md-9">
				@if(Input::has('parent') && is_numeric(Input::get('parent')))
					<select class="form-control" name="parent_id" id="parent_id">
						@foreach($parentNiches as $parentNiche)
							@if($parentNiche->id == Input::get('parent'))
								<option value="{{ $parentNiche->id }}" selected>{{ $parentNiche->label }}</option>
							@endif
						@endforeach
					</select>
					<input type="hidden" name="highlighted" value="1">
				@else
					<select class="form-control" name="parent_id" id="parent_id">
						<option></option>
						@foreach($parentNiches as $parentNiche)
							@if($niche->parent_id == $parentNiche->id)
								<option value="{{ $parentNiche->id }}" selected>{{ $parentNiche->label }}</option>
							@else
								<option value="{{ $parentNiche->id }}">{{ $parentNiche->label }}</option>
							@endif
						@endforeach
					</select>
				@endif
				{{ $errors->first('parent_id', '<span class="help-block">:message</span>') }}
			</div>
		</div>

	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Titles &amp; Keywords
	</header>
	<div class="panel-body">
		<!-- Page Title -->
		<div class="form-group {{ $errors->has('page_title') ? 'has-error' : '' }}">
			<label class="control-label col-md-3" for="page_title">Page Title</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="page_title" value="{{ Input::old('page_title', $niche->page_title) }}">
				<span class="help-block">Shortcodes are allowed: [st] [state] [city]</span>
				{{ $errors->first('page_title', '<span class="help-block">:message</span>') }}
			</div>
		</div>
		<!-- Main Keyword / Slug -->
		<div class="form-group {{ $errors->has('keyword_main') ? 'has-error' : '' }}">
			<label class="control-label col-md-3" for="keyword_main">Main Keyword / Slug</label>
			<div class="col-md-9">
				<input class="form-control" type="text" name="keyword_main" value="{{ Input::old('keyword_main', $niche->keyword_main) }}">
				<span class="help-block">Ex: <span class="label bg-light dk">Wedding Photograpers</span>, will be converted to a slug</span>
				{{ $errors->first('keyword_main', '<span class="help-block">:message</span>') }}
			</div>
		</div>
		<!-- Niche Keywords -->
		<div class="form-group {{ $errors->has('keywords') ? 'has-error' : '' }}">
			<label class="control-label col-md-3" for="keywords">Related Keywords</label>
			<div class="col-md-9">
				<input class="form-control tokenfield" type="text" name="keywords" value="{{ Input::old('keywords', $niche->present()->tokenKeywords()) }}">
				{{ $errors->first('keywords', '<span class="help-block">:message</span>') }}
				<span class="help-block">Ex: <span class="label bg-light dk">Beach Wedding Photographers</span> <span class="label bg-light dk">Wedding Ceremony Photographers</span> <span class="label bg-light dk">Marriage Photographers</span> <span class="label bg-light dk">Anniversary Photographers</span></span>
			</div>
		</div>
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Content
		<span class="label label-default bg-light pull-right">Optional</span>
	</header>
	<!-- Page Content -->
	<div class="block {{ $errors->has('content') ? 'has-error' : '' }}">
		<label class="control-label sr-only" for="content">Page Content</label>
			<textarea class="form-control ckeditor" name="content" rows="5">{{ Input::old('content', $niche->content) }}</textarea>
			{{ $errors->first('content', '<span class="help-block">:message</span>') }}
			<!-- <span class="help-block">E.G. wedding photography, fashion photography, family portraits, etc</span> -->
	</div>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Page Excerpt
		<span class="label label-default bg-light pull-right">Optional</span>
	</header>
	<div class="panel-body">
		<!-- Page Excerpt -->
		<div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
			<label class="control-label sr-only" for="excerpt">Page Excerpt</label>
			<textarea class="form-control" name="excerpt" rows="5">{{ Input::old('excerpt', $niche->excerpt) }}</textarea>
			{{ $errors->first('excerpt', '<span class="help-block">:message</span>') }}
			<!-- <span class="help-block">E.G. wedding photography, fashion photography, family portraits, etc</span> -->
		</div>
	</div>
</section>