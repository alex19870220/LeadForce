<?php

use Acme\Projects\NicheStats;
use Acme\Forms\FormValidationException;
use Acme\Forms\NicheForm;

class NichesController extends AdminController {

	protected $nicheForm;

	/**
	 * Instantiate the object
	 *
	 * @param NicheForm $nicheForm
	 */
	function __construct(NicheForm $nicheForm)
	{
		$this->nicheForm = $nicheForm;

		$parentNiches = Niche::whereNull('parent_id')->orderBy('label', 'ASC')->get();

		View::share('parentNiches', $parentNiches);

		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * GET /niches
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// Grab all the niches
		$niches = Niche::with([
			'children',
			'project' => function($q)
				{
					$q->select('id', 'niche_id', 'website_url');
				},
			])
			->where('user_id', '=', Sentry::getUser()->id)
			->where('parent_id', '=', NULL);

		if(! empty(Input::get('parent')) && is_numeric(Input::get('parent')))
			$niches = $niches->where('id', '=', Input::get('parent'));

		$niches = $niches->orderBy('created_at', 'ASC')
			->get();

		return View::make('backend.niches.dashboard', compact('niches'));
	}

	/*
	|--------------------------------------------------------------------------
	| Create
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Show the form for creating a new resource.
	 * GET /niches/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$niche = new Niche;

		return View::make('backend.niches.create', compact('niche'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /niches
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		try
		{
			$this->nicheForm->validate(Input::all());

			// Create a new niche
			$niche = new Niche;

			$niche = $this->setData($niche);

			// Set owner
			$niche->user_id = Sentry::getUser()->id;

			// Was the niche created?
			if($niche->save())
			{
				Flash::success("Niche {$niche->label} has been created!");

				if(is_null($niche->parent_id))
						return Redirect::to($niche->present()->highlightUrl);

				if(Input::has('highlighted') && Input::get('highlighted') == 1)
					return Redirect::to($niche->present()->highlightUrl($niche->parent_id));

				// Redirect to the new niche page
				return Redirect::route('edit/niche', $niche->id);
			}
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Edit
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Show the form for editing the specified resource.
	 * GET /niches/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($nicheId = null)
	{
		// Get child niches
		$childNiches = Niche::listParents()->get(['id', 'label']);

		// Check if the blog post exists
		if (is_null($niche = Niche::find($nicheId)))
		{
			// Redirect to the blogs management page
			return Redirect::to('projects')->with('error', 'That niche doesn\'t exist!');
		}

		return View::make('backend.niches.edit', compact('niche', 'childNiches'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /niches/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($nicheId)
	{
		try
		{
			// Check if the blog post exists
			if (is_null($niche = Niche::find($nicheId)))
			{
				// Redirect to the blogs management page
				return Redirect::to('projects')->with('error', 'That niche does not exist! This should never happen!');
			}

			$this->nicheForm->validate(Input::all());

			$niche = $this->setData($niche);

			// Was the niche updated?
			if($niche->save())
			{
				Flash::success("Niche {$niche->label} has been saved!");

				// Redirect to the new niche page
				return Redirect::route('edit/niche', $niche->id)->with('success', 'Niche updated.');
			}
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Sets the Niche object's data and returns it
	 *
	 * @param Niche $niche
	 */
	public function setData(Niche $niche)
	{
		// Update the data
		$niche->label				= e(Input::get('label'));
		$niche->parent_id			= (Input::get('parent_id') !== '') ? e(Input::get('parent_id')) : NULL;
		$niche->keyword_main		= ucwords(e(Input::get('keyword_main')));
		$niche->keywords			= e(Input::get('keywords'));
		$niche->slug				= strtolower(Str::slug(Input::get('keyword_main')));
		// $niche->titles				= serialize(array_map("rtrim", explode("\n", e(Input::get('titles')))));
		// $niche->content_type		= e(Input::get('content_type'));

		// Set content/excerpt/page_title/meta_title/meta_description
		$niche->content				= (Input::get('content') !== null) ? $this->setShortcodesLowercase(Input::get('content')) : Input::get('content');
		$niche->excerpt				= (Input::get('excerpt') !== null) ? $this->setShortcodesLowercase(Input::get('excerpt')) : Input::get('excerpt');
		$niche->page_title			= (Input::get('page_title') !== null) ? $this->setShortcodesLowercase(e(Input::get('page_title'))) : e(Input::get('page_title'));
		$niche->meta				= (Input::get('meta') !== null) ? $this->setShortcodesLowercase(Input::get('meta')) : Input::get('meta');
		// $niche->meta_description	= (Input::get('meta_description') !== null) ? $this->setShortcodesLowercase(e(Input::get('meta_description'))) : e(Input::get('meta_description'));

		// Clear Niche Cache if needed
		$content_hash = md5(Input::get('content'));
		if(! is_null($niche->content_hash) && $content_hash !== $niche->content_hash)
		{
			Flash::success('Content updated -> Cache has been cleared to avoid errors.');

			$this->clearNicheCache($niche->id);
		}

		$niche->content_hash		= $content_hash;

		// Update stats
		$niche = NicheStats::calculateStats($niche);

		return $niche;
	}

	/**
	 * Simple method to replace shortcodes, making them lowercase
	 *
	 * @param string $content
	 */
	public function setShortcodesLowercase($content = null)
	{
		if(empty($content) || is_null($content))
			return;

		$searchArray = ['[st]', '[state]', '[city]'];

		// dd($content);

		// Set each shortcode to lowercase
		foreach($searchArray as $searchItem)
		{
			$content = str_ireplace($searchItem, strtolower($searchItem), $content);
		}

		return $content;
	}

	/*
	|--------------------------------------------------------------------------
	| One-Click Actions
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Clears a Niche's content cache
	 *
	 * @param  integer $nicheId
	 * @return Response
	 */
	public function getClearCache($nicheId)
	{
		// Check if the blog post exists
		if (is_null($niche = Niche::find($nicheId)))
		{
			// Redirect to the blogs management page
			return Redirect::to('projects')->with('error', 'That niche does not exist! This should never happen!');
		}
		$this->clearNicheCache($niche->id);
		Flash::success("Cache cleared for {$niche->label}!");

		return Redirect::route('projects');
	}

	/**
	 * Clears the cache of a Niche's content
	 *
	 * @param  integer $niche_id
	 * @return bool
	 */
	private function clearNicheCache($niche_id)
	{
		// Give us some memory
		ini_set('memory_limit','512M');

		// Clear cache for the niche
		$tag = CacheTags::nicheTag($niche_id);
		return CacheTags::flush($tag);
	}

	/**
	 * Delete a Niche
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($nicheId)
	{
		// Check if the Niche exists
		if (is_null($niche = Niche::find($nicheId)))
		{
			Flash::error('That niche doesn\'t exist!');
			return Redirect::route('projects');
		}

		$niche->delete();
		Flash::success('Niche has been deleted!');

		return Redirect::route('projects');
	}

}