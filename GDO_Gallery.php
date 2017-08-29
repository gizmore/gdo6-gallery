<?php
namespace GDO\Gallery;

use GDO\DB\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\Template\GDT_Template;
use GDO\Type\GDT_Message;
use GDO\Type\GDT_String;
use GDO\User\GDO_User;

final class GDO_Gallery extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('gallery_id'),
            GDT_String::make('gallery_title'),
            GDT_Message::make('gallery_description'),
            GDT_CreatedBy::make('gallery_creator'),
            GDT_CreatedAt::make('gallery_created'),
        );
    }
    
    public function canEdit(GDO_User $user) { return $this->getCreatorID() === $user->getID(); }
    

    /**
     * @return User
     */
    public function getCreator() { return $this->getValue('gallery_creator'); }
    public function getCreatorID() { return $this->getVar('gallery_creator'); }
    public function getCreated() { return $this->getVar('gallery_created'); }
    
    public function getTitle() { return $this->getVar('gallery_title'); }
    public function getMessage() { return $this->getVar('gallery_description'); }
    public function displayDate() { return tt($this->getCreated()); }
    public function displayDescription() { return $this->gdoColumn('gallery_description')->renderCell(); }
    
    public function href_show() { return href('Gallery', 'Show', "&id={$this->getID()}"); }
    
    public function renderList() { return GDT_Template::php('Gallery', 'listitem/gallery.php', ['gallery'=>$this]); }
    
    public function getImages()
    {
        return $this->queryImages();
    }
    
    public function queryImages()
    {
        return GDO_GalleryImage::table()->select()->where("image_gallery={$this->getID()}")->exec()->fetchAllObjects();
    }
    
    public function getImageCount()
    {
        return $this->queryImageCount();
    }
    
    public function queryImageCount()
    {
        return GDO_GalleryImage::table()->countWhere("image_gallery={$this->getID()}");
    }
    
}
