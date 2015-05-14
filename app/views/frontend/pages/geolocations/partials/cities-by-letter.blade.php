<div class="row">
	<div class="col-md-12 text-center m-b">
		<ul class="pagination">
			@foreach($cityLetters as $cityLetter)
				@if(Route::input('cityLetter') == $cityLetter->letter)
				<li class="active">
				@else
				<li>
				@endif
					<a href="{{ route('project/state/letter', [$project->slug, $project->tld, $state->abbr, $cityLetter->letter]) }}">{{ $cityLetter->letter }}</a>
				</li>
			@endforeach
		</ul>
	</div>
</div>