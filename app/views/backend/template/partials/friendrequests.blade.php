<li class="hidden-xs">
	<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
		<i class="i i-users2"></i>
		<span class="badge badge-sm up bg-info">1</span>
	</a>
	<section class="dropdown-menu aside-xl animated flipInY">
		<section class="panel bg-white">
			<div class="panel-heading b-light bg-light">
				<strong>You have 3 {{ str_plural('friend request', 3) }}</strong>
			</div>
			<div class="list-group list-group-alt">

				<!-- Friend Requests -->
				@include('backend.template.partials.friendrequest')
				@include('backend.template.partials.friendrequest')
				@include('backend.template.partials.friendrequest')

			</div>
			<div class="panel-footer text-sm">
				<a class="pull-right fa fa-cog" href="#"></a>
				<a data-toggle="class:show animated fadeInRight" href="#">See all friend requests</a>
			</div>
		</section>
	</section>
</li>