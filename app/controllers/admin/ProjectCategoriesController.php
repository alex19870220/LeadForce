<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\ProjectCategoryForm;

class ProjectCategoriesController extends AdminController {

	/**
	 * @var ProjectCategoryForm $projectCategoryCategoryForm
	 */
	protected $projectCategoryCategoryForm;

	/**
	 * Instantiate the Object
	 *
	 * @param ProjectCategoryForm $projectCategoryCategoryForm
	 */
	function __construct(ProjectCategoryForm $projectCategoryCategoryForm)
	{
		$this->projectCategoryForm = $projectCategoryCategoryForm;

		parent::__construct();
	}

	/**
	 * Get the ProjectCategories dashboard
	 *
	 * @return Response
	 */
	public function getCategories()
	{
		$categories = ProjectCategory::with('user')
			->where('owner_id', '=', Sentry::getUser()->id)
			->orderBy('label')
			->get();

		$newCategory = new ProjectCategory;

		return View::make('backend.projectcategories.dashboard', compact('categories', 'newCategory'));
	}

	/*
	|--------------------------------------------------------------------------
	| Create
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Create a new ProjectCategory
	 *
	 * @return Response
	 */
	public function postCreateCategory()
	{
		try
		{
			$this->projectCategoryForm->validate(Input::all());

			$projectCategory = new ProjectCategory;

			$projectCategory->label		= e(Input::get('label'));
			$projectCategory->owner_id	= Sentry::getUser()->id;

			if($projectCategory->save())
			{
				Flash::success("Project {$projectCategory->label} successfully created!");

				return Redirect::route('categories');
			}

			Flash::error('Something wrong happened!');

			// Redirect to the project create page
			return Redirect::route('categories');
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
	 * Edit a Category
	 *
	 * @param  integer $categoryId
	 * @return Response
	 */
	public function getEditCategory($categoryId)
	{
		//
	}

	/**
	 * Edit a Category
	 *
	 * @param  integer $categoryId
	 * @return response
	 */
	public function postEditCategory($categoryId)
	{
		//
	}

	/*
	|--------------------------------------------------------------------------
	| Misc
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Delete a Category
	 *
	 * @param  integer $categoryId
	 * @return Response
	 */
	public function getDeleteCategory($categoryId)
	{
		// Check if the Niche exists
		if (is_null($projectCategory = ProjectCategory::find($categoryId)))
		{
			Flash::error('That Category doesn\'t exist!');

			return Redirect::route('categories');
		}

		// If category doesn't belong to user...
		if($projectCategory->id !== Sentry::getUser()->id)
			return Redirect::route('categories');

		$projectCategory->delete();

		Flash::success('Category has been deleted!');

		return Redirect::route('categories');
	}

}