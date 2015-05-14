<?php

class Post extends Eloquent {

	/**
	 * The database table used by this model
	 * @var string
	 */
	protected $table = 'posts';

	/**
	 * Deletes a blog post and all the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		// Delete the blog post
		return parent::delete();
	}

	/**
	 * Returns a formatted post content entry, this ensures that
	 * line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Return the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * Returns the post's category
	 * @return Category
	 */
	public function category()
	{
		return $this->belongsTo('Category', 'category_id');
	}

	/**
	 * Return how many comments this post has.
	 *
	 * @return array
	 */
	public function comments()
	{
		return $this->hasMany('Comment');
	}

	/**
	 * Return the URL to the post.
	 *
	 * @return string
	 */
	public function url()
	{
		return URL::to($this->createSlug(), $this->slug);
	}

	/**
	 * Return the post thumbnail image url.
	 *
	 * @return string
	 */
	public function thumbnail()
	{
		# you should save the image url on the database
		# and return that url here.
		if($this->thumbnail){
			return url('/images/thumbnails/').$this->thumbnail;
		}
	}

	/**
	 * Return the post thumbnail's thumbnail image url.
	 *
	 * @return string
	 */
	public function thumbnail_thumb()
	{
		# you should save the image url on the database
		# and return that url here.
		if($this->thumbnail){
			return url('/images/thumbnails/thumb').$this->thumbnail;
		}
	}

	// --------------------------------------------
	// Data-based methods
	// --------------------------------------------

	/**
	 * Returns 5 recent posts from the blog
	 * @return array object
	 */
	public static function recentPosts()
	{
		return static::with('category')->orderBy('created_at', 'DESC')->take(5)->get();
	}

	/**
	 * Grabs all post content for viewing a blog post
	 * @param  string $postSlug
	 * @return $post
	 */
	public static function grabPostContent($postSlug)
	{
		$post = static::whereSlug($postSlug)->with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
			'comments',
			'category'
		))->first();

		// Check if the blog post exists
		if (is_null($post))
		{
			return App::abort(404);
		}

		return $post;
	}

	/**
	 * Create the slug URL for the post
	 * @return variable
	 */
	public function createSlug()
	{
		if(isset($this->category_id)){
			return URL::route('view-post-cat', array($this->category->slug, $this->slug));
		} else {
			return URL::route('view-post', $this->slug);
		}
	}

	/**
	 * Grabs all comments for a post
	 * @return array
	 */
	public function grabComments()
	{
		return $this->comments()->with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'ASC')->get();
	}

}