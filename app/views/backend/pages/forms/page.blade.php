<section class="panel panel-primary">
	<header class="panel-heading">
		Page Setup
	</header>
	<section class="panel-body">
		<!-- Page Label 	 -->
		<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
			<label for="title">Page Title</label>
			<input class="form-control" type="text" name="title" id="title" value="{{ Input::old('title', $page->title) }}" />
			{{ $errors->first('title', '<span class="help-block">:message</span>') }}
		</div>

		<!-- Page Slug -->
		<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
			<label for="slug">Slug <span class="text-muted">(for URL)</span></label>
			<input class="form-control disabled" type="text" name="slug" id="slug" value="{{ Input::old('slug', $page->slug) }}" disabled/>
			{{ $errors->first('slug', '<span class="help-block">:message</span>') }}
		</div>

	</section>
</section>

<section class="panel panel-primary">
	<header class="panel-heading">Content</header>
	<!-- Page Content -->
	<div class="block {{ $errors->has('content') ? 'has-error' : '' }}">
		<label for="content" class="sr-only">About Us</label>
		<textarea class="form-control ckeditor" name="content" id="content" rows="5">{{ Input::old('content', $page->content) }}</textarea>
		{{ $errors->first('content', '<span class="help-block">:message</span>') }}
	</div>
</section>