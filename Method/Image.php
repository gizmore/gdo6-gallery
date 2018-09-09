<?php
namespace GDO\Gallery\Method;

use GDO\Core\Method;
use GDO\Gallery\GDO_GalleryImage;
use GDO\Util\Common;
use GDO\File\Method\GetFile;
use GDO\User\GDO_User;

/**
 * Download a gallery image.
 * @author gizmore@wechall.net
 * @version 6.08
 * @since 6.04
 */
final class Image extends Method
{
	public function execute()
	{
		$fileId = Common::getGetString('id');
		$image = GDO_GalleryImage::findBy('files_file', $fileId);
		$gallery = $image->getGallery();
		if (!$gallery->canView(GDO_User::current()))
		{
			return $this->error('err_permission');
		}
		return GetFile::make()->executeWithId($fileId);
	}
}
