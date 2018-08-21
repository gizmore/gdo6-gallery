<?php
namespace GDO\Gallery\Method;

use GDO\Form\GDT_Form;
use GDO\Form\MethodCrud;
use GDO\Gallery\GDO_Gallery;
use GDO\Core\GDO;
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
	
	public function createFormButtons(GDT_Form $form)
	{
// 		$field = GDT_ImageFile::make('images')->maxfiles(100)->minfiles(1);
// 		$field->gdo($this->getGallery());
// 		$field->previewHREF(href('Gallery', 'Image', '&id='));
// 		if ($this->crudMode === self::EDITED)
// 		{
// 			$files = [];
// 			$images = $this->getGallery()->getImages();
// 			foreach ($images as $image)
// 			{
// 				$image instanceof GDO_GalleryImage;
// 				$file = $image->getFile();
// 				$file->tempHref($image->href_show());
// 				$files[] = $file;
// 			}
// 			$field->setGDOValue($files);
// 		}
// 		$form->addFields(array(
// 			$field,
// 		));
		parent::createFormButtons($form);
	}
	
	public function afterCreate(GDT_Form $form, GDO $gdo)
	{
// 		$this->afterUpdate($form, $gdo);
	}
	
	public function afterUpdate(GDT_Form $form, GDO $gdo)
	{
// 		$images = $form->getFormValue('images');
// 		foreach ($images as $image)
// 		{
// 			$image instanceof GDO_File;
// // 			if (!$image->isPersisted())
// 			{
// 				GDO_GalleryImage::blank(array(
// 					'image_file' => $image->getID(),
// 					'image_gallery' => $gdo->getID(),
// 					'image_description' => null,
// 				))->replace();
// 			}
// 		}
	}
	
}
