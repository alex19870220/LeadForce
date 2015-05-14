<h4 class="m-t-lg m-b-lg"><i class="fa fa-comments text-muted"></i> {{ $comments->count() }} Comment(s)</h4>

@if ($comments->count())
	<section class="comment-list block">
	@foreach ($comments as $comment)
		@if($comment->parent_id)
			<article id="comment-id-{{ $comment->id }}" class="comment-item comment-reply"> <!-- Start Comment -->
		@else
			<article id="comment-id-{{ $comment->id }}" class="comment-item"> <!-- Start Comment -->
		@endif
			<a class="pull-left thumb-sm"><img src="{{ $comment->author->gravatar() }}" class="img-rounded"></a>
			<section class="comment-body m-b">
				<header>
					<a href="#reply-to-{{ $comment->id }}" class="blog-reply-to pull-right inline text-sm"><i class="fa fa-reply text-muted"></i> Reply</a>
					@if($comment->author->website)
						<a href="{{ $comment->author->website }}" rel="nofollow comment"><strong>{{ $comment->author->fullName() }}</strong></a>
					@else
						<strong>{{ $comment->author->fullName() }}</strong>
					@endif
					{{ $comment->author->title(true) }}
					<span class="text-muted text-xs block m-t-xs">{{ $comment->created_at->diffForHumans() }}</span>
				</header>
				<div class="m-t">
					<p class="m-b-none">{{ $comment->content() }}</p>
				</div>
			</section>
		</article> <!-- End Comment -->
		<hr />
	@endforeach
	</section>
@else
	<hr />
@endif

<h4 class="m-t-lg m-b"><i class="fa fa-comment text-muted"></i> Leave a comment</h4>
<form method="post" action="{{ route('view-post', $post->slug) }}">
	<!-- CSRF Token -->
	{{ Form::token() }}

	@if(!Sentry::check())
		<!-- Name & Email -->
		<div class="form-group pull-in clearfix">
			<div class="col-sm-6">
				<label for="">Your name</label>
				<input type="text" class="form-control" name="name" id="name" placeholder="Name">
				{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
			</div>
			<div class="col-sm-6">
				<label for="email">Email</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="Email">
				{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
			</div>
		</div>

		<!-- Website -->
		<div class="form-group">
			<label for="website">Website</label>
			<input type="text" class="form-control" name="website" id="website" placeholder="Website">
			{{ $errors->first('website', '<span class="help-inline">:message</span>') }}
		</div>
	@endif

	<!-- Comment -->
	<div class="form-group{{ $errors->first('comment', ' has-error') }}">
		<label for="comment">Comment</label>
		<textarea class="form-control" rows="5" name="comment" id="comment" placeholder="Your comment">{{ Input::old('comment') }}</textarea>
		{{ $errors->first('comment', '<span class="help-inline">:message</span>') }}
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success">Submit</button>
	</div>
</form>