<tr>
	<td><h5>{{ $adsense->label }}</h5></td>
	<td>{{ $adsense->publisher_id }}</td>
	<td><h5>{{ count($adsense->ads) }}</h5></span></td>
	<td>
		@include('backend.monetization.partials.adsense_actions')
	</td>
</tr>