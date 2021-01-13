<?php
namespace GDO\Gallery\Method;

use GDO\Core\Method;
use GDO\Gallery\GDO_Gallery;
use GDO\Util\Common;
use GDO\DB\GDT_Object;

final class Show extends Method
{
	public function gdoParameters()
	{
	    return array_merge(parent::gdoParameters(), [
	        GDT_Object::make('id')->table(GDO_Gallery::table())->notNull(),
	    ]);
	}
	
	public function execute()
	{
		$gallery = GDO_Gallery::findById(Common::getGetString('id'));
		return $this->templatePHP('gallery.php', ['gallery' => $gallery]);
	}
	
}
