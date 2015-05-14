<footer id="footer">
	<div class="bg-dark dk wrapper">
		<div class="container">
			<div class="row m-t m-b-xl">

				<!-- Widget -->
				<div class="col-sm-3 fadeInLeft animated" data-ride="animated" data-animation="fadeInRight" data-delay="300">
					<h4 class="text-uc m-b text-white">About Us</h4>
					<div class="brand text-primary h5">
						<img src="{{ $project->present()->templateDirectory() }}/images/logo.png" class="pull-left m-r-sm">
						<span class="text-white">{{ $project->website_title }}</span>
					</div>
					<p class="m-t"><small>We are a company invested in giving you exactly what you are looking for. Contact us with any questions or comments you may have!</small></p>
				</div>

				<!-- Widget -->
				<div class="col-sm-3 fadeInUp animated" data-ride="animated" data-animation="fadeInRight" data-delay="600">
					<h4 class="text-uc m-b text-white">Services</h4>
					<ul class="list-unstyled">
						@include('frontend.templates.default.navigation')
					</ul>
				</div>

				<!-- Widget -->
				<div class="col-sm-3 fadeInRight animated" data-ride="animated" data-animation="fadeInRight" data-delay="900">
					<h4 class="text-uc m-b text-white">Follow Us</h4>
					<ul class="list-unstyled">
						<li>
							<div class="m-t-lg">
								<a href="#" class="btn btn-icon btn-rounded btn-facebook bg-empty m-r"><i class="fa fa-facebook"></i></a>
								<a href="#" class="btn btn-icon btn-rounded btn-twitter bg-empty m-r"><i class="fa fa-twitter"></i></a>
								<a href="#" class="btn btn-icon btn-rounded btn-gplus bg-empty m-r"><i class="fa fa-google-plus"></i></a>
							</div>
						</li>
					</ul>
				</div>

				<!-- Widget -->
				<div class="col-sm-3 fadeInRight animated" data-ride="animated" data-animation="fadeInRight" data-delay="1200">
					<h4 class="text-uc m-b text-white">Contact Us</h4>
					@include('frontend.widgets.contact')
				</div>
			</div>

		</div>
	</div>
	<div class="bg-dark dker padder-v">
		<div class="container text-light padder-v">
			<div class="row">
				<div class="col-md-6 text-muted pull-left">
					Copyright &copy; 2014 <a href="{{ $project->present()->homeUrl }}" title="{{ $project->website_title }}">{{ $project->website_title }}</a>. All rights reserved.
				</div>
				<div class="col-md-6 text-right text-muted pull-right">
					<ul class="list-inline m-b-none">
						@include('frontend.partials.footer.footerlinks')
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>