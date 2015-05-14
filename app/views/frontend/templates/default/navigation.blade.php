<li {{ (Route::is('project/home') ? 'class="active"' : '') }}><a href="{{ $project->present()->homeUrl }}">Home</a></li>
<li {{ (Route::is('browse/states') ? 'class="active"' : '') }}><a href="{{ $project->present()->directoryUrl }}">Directory</a></li>
@foreach($project->pages as $page)
	{{ HTML::liLinkRoute('project/page', $page->menu_label, [$project->slug, $project->tld, $page->slug]) }}
@endforeach
<li {{ (Route::is('project/contact-us') ? 'class="active"' : '') }}><a href="{{ $project->present()->contactPageUrl }}">Contact</a></a></li>
@if($project->getOption('show_user_menu') == 1)
	@include('frontend.templates.default.partials.user_menu')
@endif