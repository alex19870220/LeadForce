@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Project Categories
@stop

{{-- Page content --}}
@section('content')
	<div class="row">
		<div class="col-md-8">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">
					Project Categories
				</header>
				<table class="table table-striped b-light">
					<thead class="l-h-2x">
						<tr>
							<th class="col-md-3">Label</th>
							<th class="col-md-2">Owner</th>
							<th class="col-md-3">Projects</th>
							<th class="col-md-3">Shared Access</th>
							<th class="col-md-1">Actions</th>
						</tr>
					</thead>
					<tbody class="l-h-2x">
						@foreach($categories as $category)
							@include('backend.projectcategories.partials.category')
						@endforeach
					</tbody>
				</table>
			</section>
		</div>
		<div class="col-md-4">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">
					Create New Category
				</header>
				<div class="panel-body">
					<form method="POST" action="{{ route('categories/create') }}">
						@include('backend.projectcategories.forms.category', ['category' => $newCategory])

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
@stop