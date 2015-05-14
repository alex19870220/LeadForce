<tr>
	<!-- Main Keyword & Content Keywords -->
	<td>
		<div class="m-t-xs">
			@if(isset($ischild) && $ischild === true) <i class="i i-arrow"></i> @endif
			<a href="{{ route('edit/niche', $niche->id) }}" class="text-lg">{{ $niche->keyword_main }}</a>
		</div>
	</td>

	<!-- Courtesy Checks -->
	<td>
		<div class="row no-gutter text-center">
			<!-- Has Excerpt  -->
			<div class="col-md-4">
				<span class="text-md m-t-none block">
					@if(! empty($niche->excerpt) && $niche->excerpt !== '')
					<i class="fa fa-check text-success"></i>
					@else
					<i class="fa fa-exclamation-circle" data-toggle="tooltip" data-original-title="No excerpt!"></i>
					@endif
				</span>
				<small class="text-muted l-h-1x m-t-xs m-b-none block">Excerpt</small>
			</div>
			<!-- Has Content -->
			<div class="col-md-4">
				<span class="text-md m-t-none block">
					@if(! empty($niche->content) && $niche->content !== '')
					<i class="fa fa-check text-success"></i>
					@else
					<i class="fa fa-exclamation-circle text-danger" data-toggle="tooltip" data-original-title="No content!"></i>
					@endif
				</span>
				<small class="text-muted l-h-1x m-t-xs m-b-none block">Content</small>
			</div>
			<!-- Keywords -->
			<div class="col-md-4">
				<span class="text-md m-t-none block">
					{{ count($niche->keywords) }}
				</span>
				<small class="text-muted l-h-1x m-t-xs m-b-none block">KW's</small>
			</div>
		</div>
	</td>

	<!-- Totals -->
	<td>
		@if(! empty($niche->content) && $niche->content !== '')
			<div class="row no-gutter text-center">
				<!-- Words -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('totals.words') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">Words</small>
				</div>
				<!-- MKW -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('totals.mkw') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[mkw]</small>
				</div>
				<!-- CKW -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('totals.ckw') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[ckw]</small>
				</div>
				<!-- [city] -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('totals.city') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[city]</small>
				</div>
				<!-- [state] -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('totals.state') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[state]</small>
				</div>
				<!-- [header] -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('totals.header') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[header]</small>
				</div>
			</div>
		@endif
	</td>

	<!-- Averages -->
	<td>
		@if(! empty($niche->content) && $niche->content !== '')
			<div class="row no-gutter text-center">
				<!-- Words -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('averages.words') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">Words</small>
				</div>
				<!-- MKW -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('averages.mkw') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[mkw]</small>
				</div>
				<!-- CKW -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('averages.ckw') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[ckw]</small>
				</div>
				<!-- [city] -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('averages.city') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[city]</small>
				</div>
				<!-- [state] -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('averages.state') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[state]</small>
				</div>
				<!-- [header] -->
				<div class="col-md-2">
					<span class="text-md m-t-none block">
						{{ $niche->getStats('averages.header') }}
					</span>
					<small class="text-muted l-h-1x m-t-xs m-b-none block">[header]</small>
				</div>
			</div>
		@endif
	</td>

	<!-- Craziest Guy Here -->
	<td>
		@include('backend.niches.partials.actions', ['niche' => $niche])
	</td>
</tr>