@extends($project->present()->templatePath.'.master')

{{-- Page title --}}
@section('title')
Search Results for "{{{ Input::get('query') }}}"
@stop

@section('content_wrapped')

@stop