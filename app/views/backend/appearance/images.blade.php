@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Images
@stop

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-8">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">
				Banner Images
			</header>
			<div class="panel-body">
				@foreach($allImages as $image)
					@include('backend.partials.images.imagebox', ['image' => $image, 'show_options' => true])
				@endforeach
			</div>
		</section>
	</div>
	<div class="col-md-4">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">
				Add New Image
			</header>
			<div class="panel-body">
				<form method="post" action="{{ route('images/create') }}" autocomplete="off" enctype="multipart/form-data">
					<!-- Label -->
					<div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
						<label class="control-label" for="label">Label</label>
						<input class="form-control" name="label" value="{{ Input::old('label') }}">
					</div>

					<!-- Image File -->
					<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
						<label class="control-label" for="image">Image File</label>
						<input type="file" class="filestyle" name="image" data-iconName="fa fa-file-image-o">
						{{ $errors->first('image', '<span class="help-block">:message</span>') }}
					</div>

					<!-- Image Type -->
					<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
						<label class="control-label" for="type">Image Type</label>
						<div class="block">
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<span class="dropdown-label">Select</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-select">
									@foreach(ImageHelper::getImageTypes() as $imageType => $imageTypeData)
										<li><a href="#"><input type="radio" name="type" value="{{ $imageType }}">
											{{ $imageTypeData->label }}
											@if($imageTypeData->constrain)
												({{ $imageTypeData->width or 'Uncontrained' }} x {{ $imageTypeData->height or 'Uncontrained' }} max size)
											@endif
										</a></li>
									@endforeach
								</ul>
							</div>
						</div>
						{{ $errors->first('type', '<span class="help-block">:message</span>') }}
					</div>

					<!-- Submit -->
					<div class="form-group">
						<!-- CSRF Token -->
						{{ Form::token() }}
						<button type="submit" class="btn btn-primary">Upload Image</button>
					</div>
				</form>
			</div>
		</section>
	</div>
</div>
@stop