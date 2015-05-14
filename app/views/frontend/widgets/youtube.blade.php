@if(isset($video) && ! empty($video))
	@extends('frontend.widgets.template.master')

	@section('widget_title')
	@overwrite

	@section('widget_body')
		<div class="ytvideo ytwrapper">
			<div class="ytvideo h_iframe">
				<!-- a transparent image is preferable -->
				<img class="ratio" src="/images/16x9.png"/>
				<iframe src="//www.youtube.com/embed/{{ $video }}" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	@overwrite
@else

	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite

@endif