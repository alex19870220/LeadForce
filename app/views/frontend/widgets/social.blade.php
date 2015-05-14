@extends('frontend.widgets.template.master')

@section('widget_title')
	Follow Us
@overwrite

@section('widget_body')
	<div class="clear block">
		<a class="btn btn-rounded btn-warning btn-icon fa fa-rss" href="#" title="RSS"></a>
		<a class="btn btn-rounded btn-twitter btn-icon fa fa-twitter" href="#" title="Twitter"></a>
		<a class="btn btn-rounded btn-facebook btn-icon fa fa-facebook" href="#" title="Facebook"></a>
		<a class="btn btn-rounded btn-gplus btn-icon fa fa-google-plus" href="#" title="Google+"></a>
		<a class="btn btn-rounded btn-info btn-icon fa fa-linkedin" href="#" title="LinkedIn"></a>
	</div>
@overwrite