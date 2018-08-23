<?php
namespace GDO\Gallery\Method;

use GDO\Form\MethodCrud;
use GDO\Gallery\GDO_Gallery;
use GDO\User\GDO_User;
use GDO\Gallery\Module_Gallery;

final class Crud extends MethodCrud
{
	public function isGuestAllowed() { return Module_Gallery::instance()->cfgGuestGalleries(); }
	
	public function hrefList()
	{
		return href('Gallery', 'GalleryList', '&user='.GDO_User::current()->getID());
	}

	public function gdoTable()
	{
		return GDO_Gallery::table();
	}

	/**
	 * @return GDO_Gallery
	 */
	public function getGallery()
	{
		return $this->gdo;
	}
}
