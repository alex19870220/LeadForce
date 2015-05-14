@if(Session::has('msg_info') || Session::get('msg_success') || Session::has('msg_danger'))
	<div
	@if(Session::has('msg_info'))
		class="alert alert-info"
	@elseif(Session::has('msg_success'))
		class="alert alert-success"
	@elseif(Session::has('msg_danger'))
		class="alert alert-danger"
	@endif
	id="msg_text">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<i class="fa fa-info-circle m-r"></i>
		@if(Session::has('msg_info'))
			{{ Session::get('msg_info') }}
		@elseif(Session::has('msg_success'))
			{{ Session::get('msg_success') }}
		@elseif(Session::has('msg_danger'))
			{{ Session::get('msg_danger') }}
		@endif
	</div>
@endif