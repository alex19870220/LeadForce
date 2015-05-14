<form class="well m-b-sm" action="{{ route('social/update-status') }}" method="POST">
	<textarea class="form-control" name="body" placeholder="What are you thinking?" rows="2"></textarea>
	<div class="m-t-sm">
		<!-- Token -->
		{{ Form::token() }}
		<button class="btn btn-sm btn-primary pull-right" type="submit">Post</button>
		<a class="btn btn-link profile-link-btn fa fa-location-arrow" href="javascript:void(0);" rel="tooltip" {{ tooltip('Add Location') }}></a>
		<a class="btn btn-link profile-link-btn fa fa-microphone" href="javascript:void(0);" rel="tooltip" {{ tooltip('Add Voice') }}></a>
		<a class="btn btn-link profile-link-btn fa fa-camera" href="javascript:void(0);" rel="tooltip" {{ tooltip('Add Photo') }}></a>
		<a class="btn btn-link profile-link-btn fa fa-file" href="javascript:void(0);" {{ tooltip('Add File') }}></a>
	</div>
</form>