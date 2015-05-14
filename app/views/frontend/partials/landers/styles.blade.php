@if(! empty($project->getOption('design.lander.bgimage')))
	<style>
		.bg-home-box {
		background-image: url('{{ ImageHelper::showImage($project->getOption('design.lander.bgimage')) }}');
		background-position: center top;
		}
	</style>
@endif