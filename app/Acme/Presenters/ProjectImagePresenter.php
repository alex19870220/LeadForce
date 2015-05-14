<?php namespace Acme\Presenters;

use ImageHelper;
use Laracasts\Presenter\Presenter;

class ProjectImagePresenter extends Presenter {

	/**
	 * Returns the path to the image
	 *
	 * @return string
	 */
	public function imagePath()
	{
		return ImageHelper::getTypeWebPath($this->entity->type) . $this->entity->filename . '.' . $this->entity->extension;
	}

	/**
	 * Gets an Image's thumbnail based on the thumbnail size
	 *
	 * @param  string $size
	 * @return string
	 */
	public function imageThumbnailPath($size)
	{
		$thumbnail = ImageHelper::getThumbnail($size);

		return ImageHelper::getTypeWebPath($this->entity->type) . 'thumbnails/' .  ImageHelper::getThumbnailFilename($this->entity->filename, $this->entity->extension, $thumbnail->width, $thumbnail->height);
	}

}