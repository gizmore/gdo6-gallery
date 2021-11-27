<?php
namespace GDO\Gallery;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\Core\GDT_Template;
use GDO\UI\GDT_Message;
use GDO\DB\GDT_String;
use GDO\User\GDO_User;
use GDO\File\GDT_ImageFiles;
use GDO\Friends\GDT_ACL;
use GDO\UI\GDT_Title;

/**
 * A gallery is a collection of images.
 * 
 * @see GDT_ImageFiles
 * @author gizmore@wechall.net
 * @version 6.11.0
 * @since 6.2.0
 */
final class GDO_Gallery extends GDO
{
	public function gdoCached() { return false; }
	public function gdoColumns()
	{
		return [
			GDT_AutoInc::make('gallery_id'),
			GDT_Title::make('gallery_title')->label('title')->notNull()->initial(t('gallery_title_suggestion', [GDO_User::current()->displayNameLabel()])),
			GDT_Message::make('gallery_description')->label('description'),
			GDT_CreatedBy::make('gallery_creator'),
			GDT_CreatedAt::make('gallery_created'),
			GDT_ACL::make('gallery_acl')->initial(Module_Gallery::instance()->cfgUserACL(GDO_User::current())->var),
			GDT_ImageFiles::make('gallery_files')->maxfiles(100)->
				scaledVersion('thumb', 320, 240)->
				fileTable(GDO_GalleryImage::table())->
				previewHREF(href('Gallery', 'Image', '&variant=thumb&id={id}')),
		];
	}
	
	/**
	 * @return GDT_ACL
	 */
	public function aclColumn() { return $this->gdoColumn('gallery_acl'); }

	public function canEdit(GDO_User $user) { return ($this->getCreatorID() === $user->getID()) || ($user->isStaff()); }
	public function canView(GDO_User $user, &$reason) { return Module_Gallery::instance()->canSeeGallery($user, $this, $reason); }
	
	

	/**
	 * @return GDO_User
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
	
	/**
	 * @return \GDO\Gallery\GDO_GalleryImage[]
	 */
	public function getImages()
	{
		return GDO_GalleryImage::table()->select('*')->
			where("files_object=" . $this->getID())->
			exec()->fetchAllObjects();
	}
	
	public function getFiles()
	{
		return $this->getValue('gallery_images');
	}
	
	public function getImageCount()
	{
		return $this->queryImageCount();
	}
	
	public function queryImageCount()
	{
		return GDO_GalleryImage::table()->countWhere("files_object={$this->getID()}");
	}
	
}
