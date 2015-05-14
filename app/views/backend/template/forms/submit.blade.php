<!-- Save Changes -->
<section class="panel panel-primary">
	<header class="panel-heading">
		Save/Update
	</header>
	<section class="panel-body">
		<!-- Form actions -->
		<div class="form-group m-b-none">
			<div class="controls">
				<button type="submit" class="btn btn-primary save-button"><i class="fa fa-floppy-o"></i>
					@if(starts_with(Route::currentRouteName(), 'edit'))
						Save
					@elseif(starts_with(Route::currentRouteName(), 'create'))
						Create
					@endif
				</button>
			</div>
		</div>
	</section>
</section>