@extends('frontend.template.master')

{{-- Breadcrumbs --}}
@if(isset($category))
	@section('breadcrumbs')
		{{ Breadcrumbs::render('view-post-cat', $category, $post) }}
	@stop
@else
	@section('breadcrumbs')
		{{ Breadcrumbs::render('view-post', $post) }}
	@stop
@endif

{{-- Page title --}}
@section('title')
{{ $post->title }}
@parent
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content')
	<div class="row">
		<!-- Posts -->
		<div class="col-md-9 clear">
			@include('frontend.blog.posts.posts')
			<hr />
			<!-- Comments -->
			@include('frontend.blog.comments')
		</div> <!-- End Column -->
		<!-- Sidebar -->
		@include('frontend.blog.sidebar')
	</div>
@stop