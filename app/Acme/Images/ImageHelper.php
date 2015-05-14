<?php namespace Acme\Images;

use File;
use Image;
use Input;
use ProjectImage;
use Str;

class ImageHelper {

	/**
	 * @var string $imagePath The path to the public images folder
	 */
	protected $imagePath = '/images/';

	/**
	 * @var array $types The sizes & dimensions of thumbnails
	 */
	protected $thumbnails = [
		'small'		=> [
			'crop'		=> true,
			'exact'		=> true,
			'width'		=> 150,
			'height'	=> 150,
		],
		'medium'	=> [
			'crop'		=> false,
			'exact'		=> false,
			'width'		=> 300,
			'height'	=> 500,
		],
		'large'		=> [
			'crop'		=> false,
			'exact'		=> false,
			'width'		=> 600,
			'height'	=> 1000,
		],
	];

	/**
	 * @var array $types
	 */
	protected $types = [
		'banner' => [
			'label'			=> 'Banner Image',
			'description'	=> 'Banner image for lander backgrounds.',
			'width'			=> 1920,
			'height'		=> 500,
			'constrain'		=> true,
			'exact'			=> true,
			'path'			=> 'banners/',
		],
		'content' => [
			'label'			=> 'Content Image',
			'description'	=> 'Images for use in content.',
			'constrain'		=> false,
			'exact'			=> false,
			'pat'			=> 'content/',
		],
	];

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		// Set the image path;
		$this->imagePath = public_path() . $this->imagePath;
	}

	public function showImage($imageId)
	{
		$image = ProjectImage::whereType('banner')->find($imageId);

		if(! $image)
			return false;

		return $image->present()->imagePath();
	}

	/**
	 * Process an image to be resized, thumbnail'd, and added to folder
	 * Then return an array of the image data
	 *
	 * @param  Symfony\Component\HttpFoundation\File\UploadedFile $image
	 * @param  string                                             $type
	 * @return array
	 */
	public function processImage(\Symfony\Component\HttpFoundation\File\UploadedFile $image, $type)
	{
		// Increase da memory
		ini_set('memory_limit','128M');

		// Get the Image's info
		$imageFilename = $this->getFilenameNoExt($image);
		$imageExtension = $image->guessExtension();
		// dd($imageFilename);
		$imageType = $this->getImageType($type);

		// Set up the path
		$imagePath = $this->getImagePath($type) . $imageFilename . '.' . $imageExtension;

		// dd($imagePath);

		// Make the image && backup for use before saving
		$newImage = Image::make(Input::file('image')->getRealPath());
		$newImage->backup();

		// Create thumbnails
		$this->createThumbnails($newImage, $imageFilename, $imageExtension, $type);

		$newImage->reset();

		if($imageType->constrain)
			$newImage = $this->resize($newImage, $imageType->width, $imageType->height);

		$this->checkFolderPath($this->getImagePath($type));

		// Save image
		if($newImage->save($imagePath))
			return [
				'filename'	=> $imageFilename,
				'extension'	=> $imageExtension,
				'path'		=> $imagePath,
				'width'		=> $newImage->width(),
				'height'	=> $newImage->height(),
			];

		return false;
	}

	/*
	|--------------------------------------------------------------------------
	| Resizing
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Resizes the image based on $width and $height, and optionally keeps the radio
	 *
	 * @param  Image    $image
	 * @param  integer  $width
	 * @param  integer  $height
	 * @return Image
	 */
	public function resize(\Intervention\Image\Image $image, $width, $height, $contrain = true, $exact = false)
	{
		// Increase da memory
		ini_set('memory_limit','128M');

		if(! is_numeric($width) || ! is_numeric($height))
			throw new InvalidArgumentException('One or more the dimensions set are not numeric.');

		// Set the args
		$imgWidth = $image->width();
		$imgHeight = $image->height();
		$setWidth = $width;
		$setHeight = $height;

		// If image is smaller than required
		if($imgWidth < $width && $imgHeight < $height)
			return $image;

		// If either dimention is equal to what's required
		if($contrain == true) //  && ($imgWidth == $width || $imgHeight == $height)
		{
			$widthCalc = ($imgWidth / $setWidth);
			$heightCalc = ($imgHeight / $setHeight);

			// Resize by the smallest Calc
			if($widthCalc < $heightCalc)
			{
				$height = null;
			}
			else
			{
				$width = null;
			}

			$image = $image->resize($width, $height, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
		}

		// If dimensions need to be perfect, add whitespace if need be
		if($exact)
			return $image->resizeCanvas($setWidth, $setHeight, 'center', false, 'ffffff');

		// Reduze the size to fit the image best if it doesn't have to be exact
		$width = ($image->width() >= $setWidth) ? $setWidth : $image->width();
		$height = ($image->height() >= $setHeight) ? $setHeight : $image->height();

		return $image->resizeCanvas($width, $height, 'center', false, 'ffffff');
	}

	/**
	 * Creates all the thumbnails in the $thumbnails list
	 *
	 * @param  Image  $image
	 * @param  string $filename
	 * @param  string $type
	 * @return Image
	 */
	public function createThumbnails(\Intervention\Image\Image $image, $filename, $extension, $type)
	{
		// Increase da memory
		ini_set('memory_limit','128M');

		$newThumb = $image->backup();

		$this->checkFolderPath($this->getThumbnailPath($type));

		foreach($this->getThumbnailSizes() as $thumbnail)
		{
			// Thumbnail setup
			$width = $thumbnail->width;
			$height = $thumbnail->height;
			$path = $this->getThumbnailPath($type) . $this->getThumbnailFilename($filename, $extension, $width, $height);

			// Resize it & save
			$newThumb = $newThumb->reset();
			$newThumb = $this->resize($newThumb, $width, $height, true, $thumbnail->exact);
			// dd($path);
			$newThumb->save($path);
		}
		// dd('done with thumbs');

		return $image;
	}

	/*
	|--------------------------------------------------------------------------
	| Filenames
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns the Image's filename without its extension
	 *
	 * @param  SymfonyComponentHttpFoundationFileUploadedFile $image
	 * @return string
	 */
	public function getFilenameNoExt(\Symfony\Component\HttpFoundation\File\UploadedFile $image)
	{
		$filename = explode('.', $image->getClientOriginalName());
		unset($filename[count($filename) - 1]);

		return Str::slug(implode('.', $filename));
	}

	/**
	 * Creates the thumbnail's filename based on its dimensions
	 *
	 * @param  string $filename
	 * @param  integer $width
	 * @param  integer $height
	 * @return string
	 */
	public function getThumbnailFilename($filename, $extension, $width, $height)
	{
		if(! is_numeric($width) || ! is_numeric($height))
			throw new InvalidArgumentException('One or more of the sizes specified are invalid.');

		return "{$filename}-{$width}x{$height}.{$extension}";
	}

	/*
	|--------------------------------------------------------------------------
	| Paths
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns the path to a certain image type
	 *
	 * @param  string $type
	 * @param  string $filename
	 * @return string
	 */
	public function getImagePath($type = '')
	{
		if(! isset($this->types[$type]['path']))
			throw new InvalidArgumentException('Image path not set or type doesn\'t exist!');

		return $this->imagePath . $this->types[$type]['path'];
	}

	/**
	 * Returns the path to a certain image type's thumbnail
	 *
	 * @param  string $type
	 * @param  string $filename
	 * @return string
	 */
	public function getThumbnailPath($type = '')
	{
		if(! isset($this->types[$type]['path']))
			throw new InvalidArgumentException('Image path not set or type doesn\'t exist!');

		return $this->getImagePath($type) . 'thumbnails/';
	}

	/**
	 * Checks if the folder path exists. If not, it creates it
	 *
	 * @param  string $path
	 * @return File
	 */
	public function checkFolderPath($path)
	{
		if(! File::isDirectory($path))
		{
			return File::makeDirectory($path, 0775);
		}

		return File::isDirectory($path);
	}

	/**
	 * Returns the web path to the Image type
	 *
	 * @param  string $type
	 * @return string
	 */
	public function getTypeWebPath($type = '')
	{
		if(! isset($this->types[$type]['path']))
			throw new InvalidArgumentException('Image path not set or type doesn\'t exist!');

		return "/images/" . $this->types[$type]['path'];
	}

	/*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Returns the Image thumbnail types
	 *
	 * @return stdClass
	 */
	public function getThumbnailSizes()
	{
		return json_decode(json_encode($this->thumbnails));
	}

	/**
	 * Returns the thumbnail type
	 *
	 * @return stdClass
	 */
	public function getThumbnail($size = '')
	{
		if(! isset($this->thumbnails[$size]))
			throw new InvalidArgumentException('Thumbnail type not set or doesn\'t exist!');

		return json_decode(json_encode($this->thumbnails[$size]));
	}

	/**
	 * Returns the Image types
	 *
	 * @return stdClass
	 */
	public function getImageTypes()
	{
		return json_decode(json_encode($this->types));
	}

	/**
	 * Returns the Image types
	 *
	 * @return stdClass
	 */
	public function getImageType($type)
	{
		return json_decode(json_encode($this->types[$type]));
	}

}