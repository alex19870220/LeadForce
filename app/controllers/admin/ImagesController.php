<?php

use Acme\Forms\FormValidationException;
use Acme\Forms\ImageForm;

class ImagesController extends AdminController {

	/**
	 * @var ImageForm $imageForm
	 */
	protected $imageForm;

	/**
	 * Instantiate the object
	 *
	 * @param ImageForm $imageForm
	 */
	function __construct(ImageForm $imageForm)
	{
		$this->imageForm = $imageForm;

		parent::__construct();
	}

	/**
	 * Show the Images dashbord
	 *
	 * @return Response
	 */
	public function getImagesIndex()
	{
		$allImages = ProjectImage::all();

		// Show the page
		return View::make('backend.appearance.images', compact('allImages'));
	}

	/**
	 * Update a new Image
	 *
	 * @return Response
	 */
	public function postUploadImage()
	{
		try
		{
			$this->imageForm->validate(Input::all());

			if(Input::hasFile('image'))
			{
				$image = Input::file('image');
				$type = Input::get('type');

				// Check for size constrains
				$checkType = ImageHelper::getImageType($type);
				if($checkType->constrain === true)
				{
					$checkImage = Image::make(Input::file('image'));

					if($checkImage->width() < $checkType->width || $checkImage->height() < $checkType->height)
					{
						Flash::error('The image you uploaded does not meet the size restraints!');

						return Redirect::back()->withInput();
					}
				}

				// Process the image
				$newImage = ImageHelper::processImage($image, $type);

				if($newImage)
				{
					$projectImage = new ProjectImage;
					$projectImage->label		= e(Input::get('label'));
					$projectImage->type			= e(Input::get('type'));
					$projectImage->filename		= $newImage['filename'];
					$projectImage->extension	= $newImage['extension'];
					$projectImage->path			= $newImage['path'];
					$projectImage->width		= $newImage['width'];
					$projectImage->height		= $newImage['height'];

					if($projectImage->save())
					{
						Flash::success('Image uploaded!');

						return Redirect::route('images');
					}

					Flash::error('Saving image to the database failed. Check that the filename is not used already.');

					return Redirect::route('images');
				}

				Flash::error('Something went wrong processing the image.');

				Redirect::back()->withInput();
			}
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Deletes a ProjectImage and its associated image
	 *
	 * @param  integer $imageId
	 * @return Response
	 */
	public function getDeleteImage($imageId)
	{
		//
	}
}