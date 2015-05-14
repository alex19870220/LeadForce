@extends('frontend.widgets.template.master')

@section('widget_title')
	{{ $widget->title }}
@overwrite

@section('widget_body')
	{{ $widget->contents }}
@overwrite