<div class="bg-dark lt bg-home-box">
	<div class="text-center wrapper container">
		<div class="row">
			<!-- home-box -->
			<div class="col-md-8 col-md-offset-2 home-box bg-white">
				<div class="m-t m-b-lg block">
					<h1 class="text-uc text-center font-bold inline">
						<div class="font-dark">
							{{ $project->getOption('design.home.headline') }}
						</div>
					</h1>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h3 class="m-t-none m-b-lg text-center">{{ $project->getOption('design.home.subheadline') }}</h3>
						@if($project->getOption('design.home.show_monetization'))

						@endif
					</div>
				</div>
			</div>
			<!-- ./home-box -->
		</div>
	</div>
</div>