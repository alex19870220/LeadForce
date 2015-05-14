<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button class="close" data-dismiss="modal" type="button">&times;</button>
			<h4 class="modal-title">
				Edit Widget
			</h4>
		</div>
		<form method="POST" action="{{ route('widgets/edit', $widget->id) }}">
			<div class="modal-body">
				@include('backend.appearance.forms.widget')
			</div>
			<div class="modal-footer">
				<a class="btn btn-default" data-dismiss="modal" href="#">Close</a>
				<button type="submit" class="btn btn-primary">Update Widget</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->