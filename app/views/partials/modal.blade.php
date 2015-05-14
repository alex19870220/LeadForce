<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button class="close" data-dismiss="modal" type="button">&times;</button>
			<h4 class="modal-title">
				@yield('title')
			</h4>
		</div>
		<form class="{{ trim($__env->yieldContent('form_class')) }}" action="{{ trim($__env->yieldContent('form_action')) }}" method="POST">
			<div class="modal-body">
				@yield('body')
			</div>
			<div class="modal-footer">
				<!-- CSRF Token -->
				{{ Form::token() }}
				@if(trim($__env->yieldContent('form_submit')))
					<a class="btn btn-default" data-dismiss="modal" href="#">Close</a>
					<button type="submit" class="btn btn-primary">{{ trim($__env->yieldContent('form_submit')) }}</button>
				@else
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				@endif
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->