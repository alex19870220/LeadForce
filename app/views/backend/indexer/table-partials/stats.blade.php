<div class="row no-gutter">
	<div class="col-md-6">
		<div class="row text-center no-gutter m-t-xs">
			<div class="col-md-4">
				<span class="text-md m-t-none block">
					<a href="https://www.google.com/webhp?sourceid=chrome-instant#q=site:{{ str_replace('.dev', '.com', $campaign->project->website_url) }}" target="_blank" {{ tooltip('View Index Count on Google') }}>
						{{ $campaign->present()->indexCountFormatted() }}
					</a>
				</span>
			</div>
			<div class="col-md-4">
				<span class="text-md m-t-none block">{{ $campaign->present()->pageCountFormatted() }}</span>
			</div>
			<div class="col-md-4">
				<span class="text-md m-t-none block">{{ $campaign->created_at->diffForHumans() }}</span>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row text-center no-gutter m-t-xs">
			<div class="col-md-3">
				<span class="text-md m-t-none block">{{ number_format($campaign->keywordCount()) }}</span>
			</div>
			<div class="col-md-3">
				<span class="text-md m-t-none block">{{ number_format($campaign->videoCount()) }}</span>
			</div>
			<div class="col-md-6">
				@if($campaign->project->stats->first())
					<span class="text-md m-t-none block">{{ $campaign->project->stats->first()->updated_at->diffForHumans() }}</span>
				@else
					<span class="text-md m-t-none block">N/A</span>
				@endif
			</div>
		</div>
	</div>
</div>