<ul class="dropdown-menu" role="menu">
	<!-- View Website -->
	<li>
		<a href="{{ $project->present()->homeUrl() }}" target="_blank">
			<i class="fa fa-fw fa-external-link"></i>
			View Website
		</a>
	</li>
	<!-- View Sitemap -->
	<li>
		<a href="{{ $project->present()->urlToSitemap() }}" target="_blank">
			<i class="fa fa-fw fa-sitemap"></i>
			View Sitemap
		</a>
	</li>
	<!-- View Video Sitemap -->
	<li>
		<a href="{{ $project->present()->urlToVideoSitemap() }}" target="_blank">
			<i class="fa fa-fw fa-file-video-o"></i>
			View Video Sitemap
		</a>
	</li>
</ul>