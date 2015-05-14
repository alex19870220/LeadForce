<?php

class Category extends Eloquent {

	//protected $fillable = [];

	/**
	 * The database table used by this model
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * Returns all categories that fall under this category
	 * @return array
	 */
	public function categories()
	{
		return $this->belongsToMany('Post');
	}

	/**
	 * Returns the posts that fall under this category
	 * @return Posts
	 */
	public function posts()
	{
		return $this->hasMany('Post', 'category_id');
	}

	/**
	 * Counts the number of posts in the category
	 * @return
	 */
	public function postCount()
	{
		return $this->posts()->count();
	}

	/**
	 * Return the URL to the category.
	 *
	 * @return string
	 */
	public function url()
	{
		return URL::route('view-category', $this->slug);
	}

	/**
	 * Returns a formatted category content entry, this ensures that
	 * line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Deletes a blog category
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Change all categories to 'uncategorized'


		// Delete the blog post
		return parent::delete();
	}

	// --------------------------------------------
	// Data-based methods
	// --------------------------------------------

	/**
	 * Returns all post categories and puts them into an array
	 * @return array object
	 */
	public static function listCategories()
	{
		return static::orderBy('name', 'ASC')->with('posts')->get();
	}

}