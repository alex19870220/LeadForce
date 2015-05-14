<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button class="close" data-dismiss="modal" type="button">&times;</button>
			<h4 class="modal-title">
				Edit Sidebar
			</h4>
		</div>
		<form method="POST" action="{{ route('sidebars/edit', $sidebar->id) }}">
			<div class="modal-body">
				@include('backend.appearance.forms.sidebar')
			</div>
			<div class="modal-footer">
				<!-- CSRF Token -->
				{{ Form::token() }}
				<a class="btn btn-default" data-dismiss="modal" href="#">Close</a>
				<button type="submit" class="btn btn-primary">Update Sidebar</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->