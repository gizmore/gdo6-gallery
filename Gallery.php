<?php
namespace GDO\Gallery;

use GDO\DB\GDO;
use GDO\DB\GDO_AutoInc;
use GDO\DB\GDO_CreatedAt;
use GDO\DB\GDO_CreatedBy;
use GDO\Template\GDO_Template;
use GDO\Type\GDO_Message;
use GDO\Type\GDO_String;
use GDO\User\User;

final class Gallery extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDO_AutoInc::make('gallery_id'),
            GDO_String::make('gallery_title'),
            GDO_Message::make('gallery_description'),
            GDO_CreatedBy::make('gallery_creator'),
            GDO_CreatedAt::make('gallery_created'),
        );
    }
    
    public function canEdit(User $user) { return $this->getCreatorID() === $user->getID(); }
    

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
    
    public function renderList() { return GDO_Template::php('Gallery', 'listitem/gallery.php', ['gallery'=>$this]); }
    
    public function getImages()
    {
        return $this->queryImages();
    }
    
    public function queryImages()
    {
        return GalleryImage::table()->select()->where("image_gallery={$this->getID()}")->exec()->fetchAllObjects();
    }
    
    public function getImageCount()
    {
        return $this->queryImageCount();
    }
    
    public function queryImageCount()
    {
        return GalleryImage::table()->countWhere("image_gallery={$this->getID()}");
    }
    
}
