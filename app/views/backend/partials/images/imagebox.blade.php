@if($image)
	<div class="img-thumbnail-hover">
		<a href="{{ $image->present()->imagePath() }}" target="_blank">
			<img class="img-thumbnail" src="{{ $image->present()->imageThumbnailPath('small') }}" alt="" />
		</a>
		@if(isset($show_options) && $show_options === true)
			<ul>
				<li><a href="#" class="btn btn-default btn-xs" {{ tooltip('Delete') }}><i class="fa fa-times text-danger"></i></a></li>
				<li><a href="#" class="btn btn-default btn-xs" {{ tooltip('Regenerate') }}><i class="fa fa-refresh text-info"></i></a></li>
			</ul>
		@endunless
		@if(isset($image_name))
			<div class="block m-t-sm radio i-checks text-center">
				<label>
					@if(isset($current) && $current == $image->id)
						<input type="radio" name="{{ $image_name }}" value="{{ $image->id }}" checked>
					@else
						<input type="radio" name="{{ $image_name }}" value="{{ $image->id }}">
					@endif
					<i></i>
					Select
				</label>
			</div>
		@endif
	</div>
@endif