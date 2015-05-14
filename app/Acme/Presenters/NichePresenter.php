<?php namespace Acme\Presenters;

use Cache;
use CacheTags;
use Config;
use ContentHandler;
use Laracasts\Presenter\Presenter;
use Request;
use Route;
use Spinner;
use Shortcodes;
use URL;

class NichePresenter extends Presenter {

	/**
	 * Current Project
	 *
	 * @var Project $project
	 */
	protected $project;

	/**
	 * Current State
	 *
	 * @var State $state
	 */
	protected $state;

	/**
	 * Current City
	 *
	 * @var City $city
	 */
	protected $city;

	/**
	 * Constructor
	 *
	 * @param $entity
	 */
	function __construct($entity)
	{
		$this->project = Route::input('projectSlug');
		$this->state   = Route::input('st');
		$this->state   = (! is_null($this->state)) ? $this->state : Route::input('stateSlug');
		$this->city    = Route::input('city');

		parent::__construct($entity);
	}

	/**
	 * Display the niche's content
	 *
	 * @return string
	 */
	public function content()
	{
		// Content data
		$rawSpintax = (! empty($this->entity->content)) ? $this->entity->content : $this->project->niche->content;

		$processedSpintax = ContentHandler::processContent($rawSpintax);

		return $processedSpintax;
	}

	/*
	|--------------------------------------------------------------------------
	| URL's
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Returns the URL to the current Niche
	 *
	 * @return [type]
	 */
	public function url($projectSlug = null, $projectTld = null, $state = null, $city = null)
	{
		if(! is_null($projectSlug) && ! is_null($projectTld) && ! is_null($state) && ! is_null($city))
			return route('project/niche', [$projectSlug, $projectTld, $state, $city, $this->entity->slug]);

		return route('project/niche', [$this->project->slug, $this->project->tld, $this->state->abbr, $this->city->slug, $this->entity->slug]);
	}

	/**
	 * Returns the URL to the Niches dashboard where only this Niche is viewable
	 *
	 * @return Response
	 */
	public function highlightUrl($nicheId = null)
	{
		if(is_null($nicheId) || ! is_numeric($nicheId))
			$nicheId = $this->entity->id;

		return route('niches', ['parent' => $nicheId]);
	}

	/*
	|--------------------------------------------------------------------------
	| Page Titles
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Show the formatted page title
	 *
	 * @return string
	 */
	public function pageTitle()
	{
		if($this->entity->page_title)
			return Shortcodes::process($this->entity->page_title);

		return ucwords("{$this->city->city} {$this->state->present()->abbr} {$this->entity->keyword_main}");
	}

	/**
	 * Return the Meta Title based on the current page
	 *
	 * @param  string $default
	 * @return string
	 */
	public function metaTitle($default = null)
	{
		// City
		if(! is_null($this->state) && ! is_null($this->city) && ! empty($this->entity->getMetaTitle('city')))
			return $this->entity->getMetaTitle('city') . $this->metaTitleEnd();

		// State
		if(! is_null($this->state) && ! empty($this->entity->getMetaTitle('state')))
			return $this->entity->getMetaTitle('state') . $this->metaTitleEnd();

		// Default
		if(is_null($default) && ! empty($this->entity->getMetaTitle('default')))
			return $this->entity->getMetaTitle('default') . $this->metaTitleEnd();

		// Fallback
		return $default . $this->metaTitleEnd();
	}

	/**
	 * Outputs the end of the Meta Title, e.g. "| Poseidon Web Studios"
	 *
	 * @return string
	 */
	public function metaTitleEnd()
	{
		$separator = (! empty($this->project->getOption('seo.misc.separator'))) ? $this->project->getOption('seo.misc.separator') : '|';
		return " {$separator} {$this->project->website_title}";
	}

	/**
	 * Return the Meta Description based on the current page
	 *
	 * @param  string $default
	 * @return string
	 */
	public function metaDescription()
	{
		// City
		if(! is_null($this->state) && ! is_null($this->city))
		{
			// If empty
			if(empty($this->entity->getMetaDescription('city')) && ! is_null($this->entity->parent_id))
				return $this->project->niche->getMetaDescription('city');

			return $this->entity->getMetaDescription('city');
		}

		// State
		if(! is_null($this->state))
		{
			// If empty
			if(empty($this->entity->getMetaDescription('state')) && ! is_null($this->entity->parent_id))
				return $this->project->niche->getMetaDescription('state');

			return $this->entity->getMetaDescription('state');
		}

		// Default empty
		if(empty($this->entity->getMetaDescription('default')) && ! is_null($this->entity->parent_id))
			return $this->project->niche->getMetaDescription('default');

		// Default
		return $this->entity->getMetaDescription('default');
	}

	/*
	|--------------------------------------------------------------------------
	| Keyword Presenters
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Return all keywords in spintax form
	 *
	 * @return string
	 */
	public function keywords()
	{
		if(is_null($this->entity->keywords) || count($this->entity->keywords) < 1 || ! is_array($this->entity->keywords))
			return false;

		return array_spin($this->entity->keywords);
	}

	/**
	 * Returns all keywords in token form
	 *
	 * @return string
	 */
	public function tokenKeywords()
	{
		if(is_null($this->entity->keywords) || count($this->entity->keywords) < 1 || ! is_array($this->entity->keywords))
			return false;

		return implode(', ', array_map('ucwords', $this->entity->keywords));
	}

	/**
	 * Lists all content keywords in an unordered list
	 *
	 * @return string
	 */
	public function listKeywords($icon = '<i class="fa fa-li fa-angle-right text-muted"></i>')
	{
		if(is_null($this->entity->keywords) || count($this->entity->keywords) < 1 || ! is_array($this->entity->keywords))
			return false;

		return '<ul class="fa-ul m-b-none m-l-sm"><li>' . $icon . ' ' . implode('</li><li> ' . $icon . ' ', array_map('ucwords', $this->entity->keywords)) . '</ul>';
	}

	/**
	 * Counts the number of keywords
	 *
	 * @return int
	 */
	public function countKeywords()
	{
		return count($this->entity->keywords);
	}

}

		// Testing shit
		// echo (! empty($this->entity->content)) ? '<!-- Original Content ID#' . $this->entity->id . '-->' : '<!-- Borrowing Content ID#' . $this->project->niche->id . '-->';

		// Hash the content, then store the hash to check for changes later
		// If its different, re-generate the content & store new path
		// $contentHashKey	= md5($rawSpintax);

		// $process_in_chunks = $this->project->getOption('process_content_chunks');

		// // Process content in chunks? *experimental*
		// if($process_in_chunks == 1)
		// {
		// 	$processedSpintax = ContentHandler::processContentInChunks($rawSpintax);
		// }
		// else
		// {
			// $processedSpintax = ContentHandler::processContent($rawSpintax);
		// }