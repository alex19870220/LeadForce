@extends('frontend.template.master')

{{-- Page title --}}
@section('title')
Blog
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<div class="row">
		<!-- Posts -->
		<div class="col-md-9 clear">
			@foreach ($posts as $post)
				@include('frontend.blog.posts.posts')
			@endforeach
			@include('frontend.blog.paginate')
		</div> <!-- End Column -->
		<!-- Sidebar -->
		@include('frontend.blog.sidebar')
	</div> <!-- End Row -->
@stop