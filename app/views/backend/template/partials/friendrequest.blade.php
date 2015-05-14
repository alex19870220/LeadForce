<a class="media list-group-item" href="#">
	<span class="pull-left thumb-sm">
		<img alt="..." class="img-circle" src="{{ $currentUser->present()->getGravatar }}">
	</span>
	<span class="media-body block m-b-none">
		<div class="block">
			{{ $currentUser->first_name }} {{ $currentUser->last_name }}
			<div class="pull-right">
				<button type="button" class="btn btn-default btn-xs" {{ tooltip('Accept') }}><i class="fa fa-check text-success"></i></button>
				<button type="button" class="btn btn-default btn-xs m-l-xs" {{ tooltip('Deny') }}><i class="fa fa-times text-danger"></i></button>
			</div>
		</div>
		<small class="block text-muted">10 minutes ago</small>
	</span>
</a>