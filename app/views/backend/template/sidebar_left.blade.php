<section class="vbox">
	<section class="w-f">
		<div class="slim-scroll" data-disable-fade-out="true" data-distance="0" data-height="auto" data-railopacity="0.2" data-size="10px">
			<nav class="nav-primary hidden-xs">
				<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Main Menu</div>
				<!-- Navigation -->
				<nav class="nav-primary hidden-xs">
					<ul class="nav nav-main" data-ride="collapse">
						@include('backend.template.navigation')
					</ul>
				</nav>
			</nav><!-- / nav -->
		</div>
	</section>

	<!-- Left Sidebar Footer -->
	<footer class="footer hidden-xs no-padder text-center-nav-xs">
		<a class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs i i-logout" data-toggle="ajaxModal" href="modal.lockme.html"></a>
		<a class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs" data-toggle="class:nav-xs" href="#nav">
			<i class="i i-circleleft text"></i>
			<i class="i i-circleright text-active"></i>
		</a>
	</footer>
</section>