<!-- Banner Image -->
<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Lander Setup
	</header>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="page-header m-t-none">Styling</h4>

				<div class="form-group">
					<label class="col-md-3 control-label">Background Image</label>
					<div class="col-md-9">
						@foreach(ProjectImage::whereType('banner')->orderBy('id', 'DESC')->get() as $image)
							@include('backend.partials.images.imagebox', ['image' => $image, 'image_name' => 'options[design.lander.bgimage]', 'current' => $project->getOption('design.lander.bgimage')])
						@endforeach
					</div>
				</div>

				<!-- Background Color -->
				<div class="form-group">
					<label class="col-md-3 control-label">Background Color</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="options[design.lander.bgcolor]" value="{{ $project->getOption('design.lander.bgcolor') }}">
						<span class="help-block">(in case of no image)</span>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>