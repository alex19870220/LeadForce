@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Leadgen Forms
@stop

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-8">
		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold">
				All Forms
			</header>
			<div class="table-responsive">
				<table class="table table-striped b-light">
					<thead class="l-h-2x">
						<tr>
							<th class="col-md-4">Label</th>
							<th class="col-md-7">Fields</th>
							<th class="col-md-1">Actions</th>
						</tr>
					</thead>
					<tbody class="l-h-2x">
					@if(isset($forms))
						@foreach($forms as $form)
							<tr>
								<td><h5>{{ $form->label }}</h5></td>
								<td>
									<div class="row">
										@if($form->fields)
											@for($x = 0;$x < count($form->fields);$x++)
												<div class="col-md-4">{{ ($x + 1) }}. {{ $form->fields[$x]->label }}</div>
											@endfor
										@endif
									</div>
								</td>
								<td>
									@include('backend.monetization.partials.leadgen_actions')
								</td>
							</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</section>
	</div>
	<div class="col-md-4">
		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold">
				Create New Lead Gen Form
			</header>
			<div class="panel-body">
				<form method="POST" action="{{ route('create/leadgen-form') }}">
					@include('backend.monetization.forms.leadgen', ['form' => $newForm])

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Create</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop