<div class="widget m-b-lg">
	<h5 class="font-semibold">Recent Posts</h5>
	<div class="line line-dashed"></div>
	<div>
		@foreach ($recentposts as $post)
			<article class="media">
				@if($post->thumbnail !== null)
					<a href="{{ $post->url() }}" class="pull-left thumb thumb-wrapper"><img src="/images/thumbnails/thumb{{ $post->thumbnail }}" alt="{{ $post->title }}" /></a>
					{{-- {{ $post->thumbnail_thumb() }} --}}
				@endif
				<div class="media-body">
					<a href="{{ $post->url() }}" class="font-semibold">{{ $post->title }}</a>
					<div class="text-xs block m-t-xs">
						@if($post->category)
							<a href="{{ $post->category->url( $post->category->slug) }}">{{ $post->category->name }}</a>
						@else
							<a href="{{ URL::to('/blog/#') }}">Uncategorized</a>
						@endif
						{{ $post->created_at->diffForHumans() }}
					</div>
				</div>
			</article>
		@endforeach
	</div>
</div>