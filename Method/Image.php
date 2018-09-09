<?php
namespace GDO\Gallery\Method;

use GDO\Core\Method;
use GDO\Gallery\GDO_GalleryImage;
use GDO\Util\Common;
use GDO\File\Method\GetFile;
use GDO\User\GDO_User;

final class Image extends Method
{
	public function execute()
	{
		$fileId = Common::getGetString('id');
		$image = GDO_GalleryImage::getBy('files_file', $fileId);
		$gallery = $image->getGallery();
		if (!$gallery->canView(GDO_User::current()))
		{
			return $this->error('err_permission');
		}
		return GetFile::make()->executeWithId($fileId);
	}
}
