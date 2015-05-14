@extends('frontend.templates.default.master')

{{-- Page title --}}
@section('title')
Home
@stop

{{-- Subtitle --}}
@section('subtitle')
	Welcome
@stop

@section('content_full')
<div class="bg-dark lter">
	<div class="pos-rlt">
		<div class="container wrapper">
			<div class="m-t m-b text-center">
				<p class="text-center m-b">
					<a href="{{ $project->present()->directoryUrl }}" class="btn btn-lg btn-dark m-sm">Browse Directory</a>
					<a href="{{ $project->present()->contactPageUrl }}" class="btn btn-lg btn-warning b-white bg-empty m-sm">Contact Us</a>
				</p>
			</div>
		</div>
	</div>
</div>

<!-- Features n Shit -->
<div class="bg-white b-b b-light">
	<div class="container">
		<div class="m-t-xl m-b text-center wrapper">
			<h1 class="font-thin">
				More than <span class="text-primary">3,200 customers</span> love our [mkw]
			</h1>
		</div>
		<div class="m-t m-b text-center wrapper">
			<p class="h2 m-b">
				Finding your <span class="text-primary">local area's</span> best [mkw] is now possible!
			</p>
		</div>
	</div>
</div>

<div class="bg-light lt">
	<div class="container">
		<div class="wrapper m-t-lg m-b-lg">
			@include('frontend.partials.content.top-cities')
		</div>
	</div>
</div>

@stop