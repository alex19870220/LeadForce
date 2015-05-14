@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Niches Dashboard
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/niche') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Create Niche</a>
@stop

{{-- Page content --}}
@section('content')

	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-sm-3">Niche Label</th>
				<th class="col-sm-4">Services</th>
				<th class="col-sm-2">Template</th>
				<th class="col-sm-2">Keywords</th>
				<th class="col-sm-2">Created</th>
			</tr>
		</thead>
		<tbody class="l-h-2x">
			@foreach ($niches as $niche)
			<tr>
				<td><a href="{{ route('edit/niche', $niche->id) }}"><strong>{{ $niche->label }}</strong></a></td>
				<td>
					@foreach($niche->services AS $niche->service)
						<span class="label label-info">{{ $niche->service->label }}</span>
					@endforeach
				</td>
				<td>{{ $niche->template or '<i class="text-muted">No Template</i>' }}</td>
				<td></td>
				<td>{{ $niche->created_at->diffForHumans() }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@stop