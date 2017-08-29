<?php
namespace GDO\Gallery\Method;

use GDO\Gallery\GDO_Gallery;
use GDO\Table\MethodQueryList;
use GDO\Util\Common;

final class GalleryList extends MethodQueryList
{
    public function gdoTable()
    {
        return GDO_Gallery::table();
    }

    public function gdoQuery()
    {
        $query = $this->gdoTable()->select();
        if ($userId = Common::getGetInt('user'))
        {
            $query->where('gallery_creator='.$userId);
        }
        return $query;
    }
    
}
