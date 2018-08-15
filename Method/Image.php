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
		$image = GDO_GalleryImage::getById(Common::getGetString('id'));
		return GetFile::make()->executeWithId($image->getFile()->getID());
	}
}
