@if(Session::has('flash_notification.message'))
	<div class="alert alert-{{ Session::get('flash_notification.level') }}">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		@if(is_array(Session::get('flash_notification.message')))
			<ul class="fa-ul">
			@foreach(array_flatten(Session::get('flash_notification.message')) as $error)
				<li><i class="fa fa-fw fa-angle-right"></i> {{ $error }}</li>
			@endforeach
			</ul>
		@else
			{{ Session::get('flash_notification.message') }}
		@endif
	</div>
@endif