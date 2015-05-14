<div class="input-group-btn">
	<button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-cogs"></i> Actions
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li><a href="{{ route('categories/edit', $category->id) }}" data-toggle="ajaxModal"><i class="fa fa-pencil"></i> Edit</a></li>
		<li><a href="{{ route('categories/delete', $category->id) }}" data-confirm><i class="glyphicon glyphicon-remove-circle"></i> Delete</a></li>
	</ul>
</div>