<?php
namespace GDO\Gallery\Method;

use GDO\Core\Method;
use GDO\GWF\Method\GetFile;
use GDO\Gallery\GDO_GalleryImage;
use GDO\Util\Common;

final class Image extends Method
{
    public function execute()
    {
        $image = GDO_GalleryImage::getById(Common::getGetString('id'));
        return $this->renderImage($image, method('GWF', 'GetFile'));
    }
    
    private function renderImage(GDO_GalleryImage $image, GetFile $method)
    {
        return $method->executeWithId($image->getFile()->getID());
    }
}