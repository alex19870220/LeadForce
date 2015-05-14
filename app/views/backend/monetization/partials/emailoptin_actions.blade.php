<div class="input-group-btn">
	<button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> Actions <span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><a href="{{ route('edit/email-optin', $form->id) }}" data-toggle="ajaxModal"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>
		<li><a href="#"><i class="fa fa-fw fa-code-fork"></i> Split Test</a></li>
		<li class="divider"></li>
		<li><a href="{{ route('delete/email-optin', $form->id) }}"><i class="glyphicon fa-fw glyphicon-remove-circle"></i> Delete</a></li>
	</ul>
</div>