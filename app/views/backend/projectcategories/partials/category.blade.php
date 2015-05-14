<tr>
	<td>
		<h5 class="m-t-sm">{{ $category->label }}</h5>
	</td>
	<td>{{ $category->user->first_name }}</td>
	<td></td>
	<td></td>
	<td>
		@include('backend.projectcategories.partials.actions')
	</td>
</tr>