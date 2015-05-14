<div class="col-md-6">
	<div class="row no-gutter text-center">
		<!-- Content Check -->
		<div class="col-md-3" style="position: inherit;">
			<span class="text-lg m-t-none">
				@if($project->present()->contentStatusIcon())
				<i class="fa fa-file-text-o text-success"></i>
				@else
				<i class="fa fa-file-o text-danger" {{ tooltip('No Content?!') }}></i>
				@endif
			</span>
		</div>

		<!-- Piwik Check -->
		<div class="col-md-3" style="position: inherit;">
			<span class="text-lg m-t-none">
				@if($project->present()->piwikStatusIcon())
				<i class="fa fa-bar-chart-o text-success"></i>
				@else
				<i class="fa fa-question-circle text-danger" {{ tooltip('No Piwik Account!') }}></i>
				@endif
			</span>
		</div>

		<!-- Adsense Check -->
		<div class="col-md-3" style="position: inherit;">
			<span class="text-lg m-t-none">
				@if($project->present()->adsenseStatusIcon())
				<i class="fa fa-google text-success"></i>
				@else
				<i class="fa fa-google text-danger" {{ tooltip('Adsense is Off!') }}></i>
				@endif
			</span>
		</div>

		<!-- Monetization Check -->
		<div class="col-md-3" style="position: inherit;">
			<span class="text-lg m-t-none">
				@if($project->present()->monetizationStatusIcon())
				{{ $project->present()->monetizationStatusIcon() }}
				@else
				<i class="fa fa-exclamation-circle text-danger" {{ tooltip('None!') }}></i>
				@endif
			</span>
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="row no-gutter text-center">

		<!-- Indexer Campaign Check -->
		<div class="col-md-3" style="position: inherit;">
			<span class="text-lg m-t-none">
				@if($project->present()->indexerStatusIcon())
				<i class="fa fa-rss-square text-success"></i>
				@else
				<span {{ tooltip('No Indexer Campaign!') }}><i class="fa fa-rss-square text-danger"></i></span>
				@endif
			</span>
		</div>

		<!-- Indexed Pages -->
		<div class="col-md-3" style="position: inherit;">
			<span class="text-lg m-t-none">
				@if($project->stats->first())
					{{ $project->stats->first()->present()->indexCountFormatted() }}
				@else
					{{ Config::get('acme.display.empty.number') }}
				@endif
			</span>
		</div>

		<!-- Project Pages -->
		<div class="col-md-3" style="position: inherit;">
			<span class="text-lg m-t-none">
				@if($project->stats->first())
					{{ $project->stats->first()->present()->pageCountFormatted() }}
				@else
					{{ Config::get('acme.display.empty.number') }}
				@endif
			</span>
		</div>

		<!-- Index Percent -->
		<div class="col-md-3" style="position: inherit;">
			<span class="text-lg m-t-none font-bold">
				@if($project->stats->first())
					@if($project->stats->first()->present()->indexPercent() <= 25)
						<span class="text-danger">
					@elseif($project->stats->first()->present()->indexPercent() <= 50)
						<span class="text-warning">
					@else
						<span class="text-success">
					@endif
						{{ $project->stats->first()->present()->indexPercent() }}%
					</span>
				@else
					<span class="text-muted">0%</span>
				@endif
			</span>
		</div>

	</div>
</div>