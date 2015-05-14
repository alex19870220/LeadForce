@if(! $campaign->active)
<form class="m-r-xs" action="{{ route('indexer/start', $campaign->id) }}" method="POST">
@else
<form class="m-r-xs" action="{{ route('indexer/stop', $campaign->id) }}" method="POST">
@endif
	<!-- CSRF Token -->
	{{ Form::token() }}
	<div class="input-group-btn">
		@if($campaign->active)
			<button type="submit" tabindex="-1" class="btn btn-default" {{ tooltip('Stop Indexing') }}><i class="fa fa-fw fa-times-circle text-danger"></i> Stop</button>
		@else
			<button type="submit" class="btn btn-default" tabindex="-1" {{ tooltip('Start Indexing') }}><i class="fa fa-fw fa-play-circle text-success"></i> Start</button>
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{{ route('indexer/scrape-videos', $campaign->id) }}"><i class="fa fa-fw fa-file-video-o"></i> Scrape Videos</a></li>
				<li><a href="{{ route('indexer/rebuild-sitemap', $campaign->project->id) }}"><i class="fa fa-fw fa-sitemap"></i> Rebuild Sitemap</a></li>
				<li><a href="{{ route('indexer/rebuild-video-sitemap', $campaign->project->id) }}"><i class="fa fa-fw fa-file-video-o"></i> Rebuild Video Sitemap</a></li>
				<li class="divider"></li>
				<li><a href="{{ route('indexer/ping-sitemap', $campaign->project->id) }}"><i class="fa fa-fw fa-rss"></i> Ping Sitemaps</a></li>
				<li><a href="{{ route('indexer/get-indexer-services', $campaign->project->id) }}" data-toggle="ajaxModal"><i class="fa fa-fw fa-code-fork"></i> Indexer Services</a></li>
				<li class="divider"></li>
				<li><a href="{{ route('delete/indexer', $campaign->id) }}" data-confirm><i class="glyphicon glyphicon-remove-circle"></i> Delete</a></li>
			</ul>
		@endif
	</div>
</form>