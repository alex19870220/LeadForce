@if(! $project->sidebar)

	@include('frontend.partials.sidebar_default')

@else

	@include('frontend.partials.sidebar_custom')

@endif