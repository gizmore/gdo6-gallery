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
    public function saveLastUrl() { return false; }
    
    public function execute()
	{
		$fileId = Common::getRequestString('id');
		$image = GDO_GalleryImage::findBy('files_file', $fileId);
		$gallery = $image->getGallery();
		$reason = '';
		if (!$gallery->canView(GDO_User::current(), $reason))
		{
			return $this->error('err_not_allowed', [$reason]);
		}
		return GetFile::make()->executeWithId($fileId, Common::getRequestString('variant'));
	}
}
