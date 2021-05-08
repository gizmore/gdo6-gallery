<?php
namespace GDO\Gallery\Method;

use GDO\Gallery\GDO_Gallery;
use GDO\Table\MethodQueryList;
use GDO\Util\Common;
use GDO\Core\GDT_Response;
use GDO\User\GDT_User;
use GDO\User\GDO_User;
use GDO\UI\GDT_Button;

final class GalleryList extends MethodQueryList
{
	public function gdoParameters()
	{
		return array_merge(parent::gdoParameters(), array(
			GDT_User::make('user')->noFilter(),
		));
	}
	
	/**
	 * @return GDO_Gallery
	 */
	public function gdoTable()
	{
		return GDO_Gallery::table();
	}

	public function getQuery()
	{
		$galleries = $this->gdoTable();
		$query = $galleries->select();
		$query->joinObject('gallery_creator');
		if ($userId = (int) $this->gdoParameterVar('user'))
		{
			$query->where("gallery_creator=$userId");
		}
		else
		{
			# Prepare query for acl condition
			$galleries->aclColumn()->aclQuery(
				$query, GDO_User::current(), 'gallery_creator');
		}
		return $query;
	}
	
	public function execute()
	{
		$response = GDT_Response::make();
		
		# Own gallery allows you to add an image.
		if (Common::getGetString('user') === GDO_User::current()->getID())
		{
			$link = GDT_Button::make('link_gallery_add')->icon('create')->href(href('Gallery', 'Crud'));
			$response->addField($link);
		}
		
		# Append the list
		return $response->addField(parent::execute());
	}
	
}
