<section class="panel b-a b-dark">
	<div class="panel-heading bg-dark">
		<h3 class="m-t-xs m-b-xs font-bold">Top Cities</h3>
	</div>
	<div class="panel-body">
		<div class="row m-t m-b">
			@foreach(City::with('state')->orderBy('population', 'DESC')->limit(100)->get() as $popularCity)
				<div class="col-sm-6 col-md-3">
					<ul class="m-b-xs">
						<li>
							<a href="{{ $popularCity->present()->url($project->slug, $project->tld, $popularCity->state->abbr) }}" title="{{ $popularCity->city }}, {{ $popularCity->state->state }}">
								{{ $popularCity->city }}, {{ $popularCity->state->present()->abbr }}
							</a>
						</li>
					</ul>
				</div>
			@endforeach
		</div>
	</div>
</section>