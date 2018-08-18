<?php
namespace GDO\Gallery\Method;

use GDO\Core\Method;
use GDO\Gallery\GDO_GalleryImage;
use GDO\Util\Common;
use GDO\File\Method\GetFile;

final class Image extends Method
{
	public function execute()
	{
		$fileId = Common::getGetString('id');
		$image = GDO_GalleryImage::getBy('files_file', $fileId);
		$gallery = $image->getGallery();
		return GetFile::make()->executeWithId($fileId);
	}
}
