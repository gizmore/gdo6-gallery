<?php
namespace GDO\Gallery\Method;

use GDO\File\GDT_File;
use GDO\Form\GDT_Form;
use GDO\Form\MethodCrud;
use GDO\Gallery\Gallery;
use GDO\Gallery\GalleryImage;
use GDO\DB\GDO;

final class Crud extends MethodCrud
{
    public function hrefList()
    {
        return href('Gallery', 'List');
    }

    public function gdoTable()
    {
        return Gallery::table();
        
    }

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gdo;
    }
    
    public function createFormButtons(GDT_Form $form)
    {
        $field = GDT_File::make('images')->imageFile()->maxfiles(100)->minfiles(1);
        if ($this->crudMode === self::EDITED)
        {
            $files = [];
            $images = $this->getGallery()->getImages();
            foreach ($images as $image)
            {
                $image instanceof GalleryImage;
                $file = $image->getFile();
                $file->tempHref($image->href_show());
                $files[] = $file;
            }
            $field->setGDOValue($files);
        }
        $form->addFields(array(
            $field,
        ));
        parent::createFormButtons($form);
    }
    
    public function afterCreate(GDT_Form $form, GDO $gdo)
    {
        $images = $form->getFormVar('images');
        foreach ($images as $image)
        {
            GalleryImage::blank(array(
                'image_file' => $image->getID(),
                'image_gallery' => $gdo->getID(),
                'image_description' => null,
            ))->replace();
        }
    }
    
}
