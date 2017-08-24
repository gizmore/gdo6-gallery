<?php
namespace GDO\Gallery;

use GDO\DB\GDO;
use GDO\DB\GDO_AutoInc;
use GDO\DB\GDO_CreatedAt;
use GDO\DB\GDO_Object;
use GDO\File\File;
use GDO\File\GDO_File;
use GDO\Template\GDO_Template;
use GDO\Type\GDO_Message;

final class GalleryImage extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDO_AutoInc::make('image_id'),
            GDO_File::make('image_file')->imageFile(),
            GDO_Object::make('image_gallery')->table(Gallery::table()),
            GDO_Message::make('image_description')->max(512),
            GDO_CreatedAt::make('image_created'),
        );
    }
    
    /**
     * @return Gallery
     */
    public function getGallery() { return $this->getValue('image_gallery'); }
    public function getGalleryID() { return $this->getVar('image_gallery'); }

    /**
     * @return File
     */
    public function getFile() { return $this->getValue('image_file'); }
    
    
    /**
     * @return User
     */
    public function getCreator() { return $this->getGallery()->getCreator(); }
    public function getCreated() { return $this->getVar('image_created'); }
    public function displayDate() { return tt($this->getCreated()); }
    public function getDescription() { return $this->getVar('image_description'); }
    public function displayDescription() { return $this->gdoColumn('image_description')->renderCell(); }
    public function href_show() { return href('Gallery', 'Image', "&id={$this->getID()}"); }
    
    
    public function renderCard()
    {
        return GDO_Template::php('Gallery', 'card/gallery_image.php', ['image' => $this]);
    }
}
