<?php
namespace GDO\Gallery\Method;

use GDO\Core\Method;
use GDO\Gallery\Gallery;
use GDO\Util\Common;

final class Show extends Method
{
    public function execute()
    {
        $gallery = Gallery::findById(Common::getGetString('id'));
        return $this->templatePHP('gallery.php', ['gallery' => $gallery]);
    }
    
}
