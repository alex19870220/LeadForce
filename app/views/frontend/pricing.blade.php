@extends('frontend.template.master')

{{-- Page title --}}
@section('title')
Pricing
@stop

{{-- Subtitle --}}
@section('subtitle')
	Highly affordable prices to get you on your feet, or on the moon
@stop

@section('content')
	<div class="m-b-xl text-center">
		<h2>Find the Right Pricing Plan For You</h2>
	</div>
	<div class="clearfix">
			<div class="row m-b-xl">
				<div class="col-sm-4 animated fadeInLeftBig">
					<section class="panel b-light text-center m-t">
						<header class="panel-heading bg-white b-light">
							<h3 class="m-t-sm">Starter</h3>
							<p>for beginners and smaller networks</p>
						</header>
						<ul class="list-group">
							<li class="list-group-item text-center bg-light lt"><span class="text-danger font-bold h1">$1</span> / month</li>
							<li class="list-group-item">5 scraping threads</li>
							<li class="list-group-item">Max 3 domain lists</li>
							<li class="list-group-item">10,000 domains per list</li>
							<li class="list-group-item">Checks availability</li>
							<li class="list-group-item">Checks all metrics</li>
						</ul>
						<footer class="panel-footer"><a href="#" class="btn btn-primary m-t m-b">Join Now</a></footer>
					</section>
				</div>
				<div class="col-sm-4 animated fadeInUp">
					<section class="panel b-primary text-center">
						<header class="panel-heading bg-primary">
							<h3 class="m-t-sm">Business</h3>
							<p>for decently sized networks</p>
						</header>
						<ul class="list-group">
							<li class="list-group-item text-center bg-light lt"><div class="padder-v"><span class="text-danger font-bold h1">$2</span> / month</div></li>
							<li class="list-group-item">15 scraping threads</li>
							<li class="list-group-item">Max 10 domain lists</li>
							<li class="list-group-item">50,000 domains per list</li>
							<li class="list-group-item">Checks availability</li>
							<li class="list-group-item">Checks all metrics</li>
						</ul>
						<footer class="panel-footer"><a href="#" class="btn btn-primary m-t m-b">Join Now</a></footer>
					</section>
				</div>
				<div class="col-sm-4 animated fadeInRightBig">
					<section class="panel b-light text-center m-t">
						<header class="panel-heading bg-white b-light">
							<h3 class="m-t-sm">Dominator</h3>
							<p>for hardcore private networks</p>
						</header>
						<ul class="list-group">
							<li class="list-group-item text-center bg-light lt"><span class="text-danger font-bold h1">$3</span> / month</li>
							<li class="list-group-item">40 scraping threads</li>
							<li class="list-group-item">Max 50 domain lists</li>
							<li class="list-group-item">150,000 domains per list</li>
							<li class="list-group-item">Checks availability</li>
							<li class="list-group-item">Checks all metrics</li>
						</ul>
						<footer class="panel-footer"><a href="#" class="btn btn-primary m-t m-b">Join Now</a></footer>
					</section>
				</div>
			</div>
		</div>
	</div>
@stop