<div class="widget m-b-lg">
	<h5 class="font-semibold">Categories</h5>
	<div class="line line-dashed"></div>
	<ul class="list-unstyled">
		@foreach($categories as $category)
			<li><span class="badge pull-right">{{ $category->postCount() }}</span><a href="{{ $category->url($category->slug) }}" title=""><i class="fa fa-angle-right"></i> {{ $category->name }}</a></li>
			<li class="line"></li>
		@endforeach
		<li><span class="badge pull-right">#</span><a href="#" title=""><i class="fa fa-angle-right"></i> Uncategorized</a></li>
	</ul>
</div>