@extends($project->present()->templatePath.'.master')

{{-- Page title --}}
@section('title')
	Disclaimer
@stop

{{-- Subtitle --}}
@section('subtitle')

@stop

@section('content_wrapped')
	<p>The information contained in {{ $project->website_title }} is for general information purposes only. The information is provided by This site and while we endeavor to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to This site or the information, products, services, or related graphics contained on Additive Manufacturing USA for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p>
	<p>In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of This site.</p>
	<p>Through This site you are able to link to other websites which are not under the control of This site. We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.</p>
	<p>Every effort is made to keep This site up and running smoothly. However,This site takes no responsibility for, and will not be liable for, {{ $project->website_title }} being temporarily unavailable due to technical issues beyond our control.</p>
@stop