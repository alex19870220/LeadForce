@if(! is_null($project->tracking_id) && is_int($project->tracking_id) && $project->tracking_id !== 0)
	<!-- Piwik -->
	{{ PiwikTracker::getCode() }}
	<noscript><p><img src="/piwik.php?{{ http_build_query(['url' => Request::getUri(), 'rand' => str_random(6), 'action_name' => trimSpace($project->present()->pageTitle($__env->yieldContent('title')))]) }}" style="border:0;" alt="" /></p></noscript>
	<!-- End Piwik Code -->
@endif