@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Email Optin Setup
@stop

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-8">
		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold">
				Email Optin Forms
			</header>
			<div class="table-responsive">
				<table class="table table-striped b-light">
					<thead class="l-h-2x">
						<tr>
							<th class="col-md-5"><span class="m-r-sm">ID</span> Label</th>
							<th class="col-md-5">Title &amp; Subtext</th>
							<th class="col-md-1">Actions</th>
						</tr>
					</thead>
					<tbody class="l-h-2x">
					@if($forms)
						@foreach($forms as $form)
							<tr>
								<td><h5><span class="m-r-sm font-bold">{{ $form->id }}</span> {{ $form->label }}</h5></td>
								<td>
									<strong>{{ $form->title }}</strong>
									<p>{{ $form->sub_text }}</p>
								</td>
								<td>
									@include('backend.monetization.partials.emailoptin_actions', compact('form'))
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
				Create New Email Optin
			</header>
			<div class="panel-body">
				<form method="POST" action="{{ route('create/email-optin') }}">
					@include('backend.monetization.forms.emailoptin', ['form' => $newForm])

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Create</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop