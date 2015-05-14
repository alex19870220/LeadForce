<li class="hidden-xs">
	<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
		<i class="i i-chat3"></i>
		<span class="badge badge-sm badge-danger up">2</span>
	</a>
	<section class="dropdown-menu aside-xl animated flipInY">
		<section class="panel bg-white">
			<div class="panel-heading b-light bg-light">
				<strong>You have 2 notifications</strong>
			</div>
			<div class="list-group list-group-alt">
				<a class="media list-group-item" href="#">
					<span class="pull-left thumb-sm">
						<img alt="..." class="img-circle" src="{{ $currentUser->present()->getGravatar }}">
					</span>
					<span class="media-body block m-b-none">
						Use awesome animate.css<br />
						<small class="text-muted">10 minutes ago</small>
					</span>
				</a>
				<a class="media list-group-item" href="#">
					<span class="media-body block m-b-none">
						1.0 initial released<br />
						<small class="text-muted">1 hour ago</small>
					</span>
				</a>
			</div>
			<div class="panel-footer text-sm">
				<a class="pull-right fa fa-cog" href="#"></a>
				<a data-toggle="class:show animated fadeInRight" href="#notes">See all the notifications</a>
			</div>
		</section>
	</section>
</li>