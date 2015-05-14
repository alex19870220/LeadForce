@foreach($project->sidebar->widgets as $widget)

	{{-- Hard coded widgets --}}
	@if($widget->type == 'hardcoded')
		{{-- Check if View exists --}}
		@if(View::exists($widget->view))
			@include($widget->view)
		@endif

	{{-- Custom HTML widgets --}}
	@elseif($widget->type == 'html')
		@if(View::exists('frontend.widgets.custom'))
			@include('frontend.widgets.custom', ['widget' => $widget])
		@endif

	{{-- Optin Forms --}}
	@elseif($widget->type == 'emailoptin')
		@if(View::exists('frontend.widgets.emailoptin'))
			@include('frontend.widgets.emailoptin', ['widget' => $widget])
		@endif
	@endif

@endforeach

{{-- YouTube Widget --}}
@if(isset($video) && ! empty($video))
	@include('frontend.widgets.youtube')
@endif