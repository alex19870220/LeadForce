@extends('partials.modal')

{{-- Modal Title --}}
@section('title')
	Preview Leadgen Form
@stop

{{-- Modal Body --}}
@section('body')
	<section class="panel panel-default" style="overflow: visible;">
		<header class="panel-heading font-bold">
			{{ $leadgenForm->label }}: Parameters
		</header>
		<table class="table table-striped b-light">
			<thead class="l-h-2x">
				<tr>
					<th class="col-md-4">Parameter</th>
					<th class="col-md-8">Value</th>
				</tr>
			</thead>
			<tbody class="l-h-2x">
				<tr>
					<td>Action</td>
					<td>{{ $leadgenForm->form_action }}</td>
				</tr>
				@foreach($leadgenForm->form_data as $formData)
					<tr>
						<td>{{ $formData->name }}</td>
						<td>{{ $formData->value }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</section>

	<section class="panel panel-default" style="overflow: visible;">
		<header class="panel-heading font-bold">
			{{ $leadgenForm->label }}: Form Preview
		</header>
		<div class="panel-body">
			{{ LeadgenFormHelper::buildFormHtml($leadgenForm->fields) }}
		</div>
	</section>
@stop