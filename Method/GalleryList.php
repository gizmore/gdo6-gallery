<?php
namespace GDO\Gallery\Method;

use GDO\Gallery\GDO_Gallery;
use GDO\Table\MethodQueryList;
use GDO\Util\Common;
use GDO\Core\GDT_Response;
use GDO\UI\GDT_Link;
use GDO\User\GDT_User;
use GDO\User\GDO_User;

final class GalleryList extends MethodQueryList
{
	public function gdoParameters()
	{
		return array_merge(parent::gdoParameters(), array(
			GDT_User::make('user'),
		));
	}
	
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
	
	public function execute()
	{
		$response = GDT_Response::make();
		
		# Own gallery allows you to add an image.
		if (Common::getGetInt('user') == GDO_User::current()->getID())
		{
			$link = GDT_Link::make('link_gallery_add')->icon('create')->href(href('Gallery', 'Crud'));
			$response->addField($link);
		}
		
		# Append the list
		return $response->add(parent::execute());
	}
	
}
