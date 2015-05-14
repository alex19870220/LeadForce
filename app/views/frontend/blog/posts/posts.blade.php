<div class="post-item">
	@if($post->thumbnail !== null)
	<div class="post-media">
		<a href="{{ $post->url() }}"><img src="/images/thumbnails/{{ $post->thumbnail }}" class="" alt="{{ $post->title }}"></a>
	</div>
	@endif
	<div class="caption wrapper-lg">
		<h2 class="post-title">
			<a href="{{ $post->url() }}">{{ $post->title }}</a>
		</h2>
		<div class="post-sum">
			<p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
		</div>
		<div class="line line-lg"></div>
		<ul class="list-inline text-muted">
			<!--<li><i class="fa fa-folder-open"></i> Posted in <a href="http://best-penny-stocks.net/uncategorized/">Uncategorized</a></li>-->
			<li><i class="fa fa-user icon-muted"></i> by {{ $post->author->first_name }}</li>
			<li><i class="fa fa-clock-o icon-muted"></i> {{ $post->created_at->diffForHumans() }}</li>
			<li><i class="fa fa-th-large icon-muted"></i>
			@if($post->category)
				Posted in <a href="{{ $post->category->url() }}">{{ $post->category->name or '<i class="text-muted">Uncategorized</i>' }}</a>
			@else
				<span class="text-muted">Uncategorized</span>
			@endif
			</li>
			<li><i class="fa fa-comment-o icon-muted"></i>
				<a href="{{ $post->url() }}#comments">{{ $post->comments()->count() }} Comments</a>
			</li>
		</ul>
	</div>
</div>