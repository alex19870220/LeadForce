<tr>
	<td><h5>{{ $widget->label }}</h5></td>
	<td>{{ $widget->title }}</td>
	<td><span class="label label-default">{{ $widget->type }}</span></td>
	<td>
		@include('backend.appearance.partials.widget_action')
	</td>
</tr>