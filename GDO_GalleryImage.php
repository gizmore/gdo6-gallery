<?php
namespace GDO\Gallery;

use GDO\File\GDO_File;
use GDO\Core\GDT_Template;
use GDO\User\GDO_User;
use GDO\File\GDO_FileTable;
use GDO\DB\GDT_String;

/**
 * A table that maps Files to Galleries.
 * Required by GDT_Files.
 *  
 * @author gizmore@wechall.net
 * @since 6.07
 * @version 6.08
 * 
 * @see GDO_FileTable
 * @see GDT_Files
 */
final class GDO_GalleryImage extends GDO_FileTable
{
	#################
	### FileTable ###
	#################
	public function gdoFileObjectTable() { return GDO_Gallery::table(); }

	###########
	### GDO ###
	###########
	public function gdoColumns()
	{
		return array_merge(parent::gdoColumns(), array(
			GDT_String::make('files_description'),
		));
	}

	##############
	### Getter ###
	##############
	/**
	 * @return GDO_File
	 */
	public function getFile() { return $this->getValue('files_file'); }
	public function getFileID() { return $this->getVar('files_file'); }
	
	/**
	 * @return GDO_Gallery
	 */
	public function getGallery() { return $this->getValue('files_object'); }
	public function getGalleryID() { return $this->getVar('files_object'); }
	
	/**
	 * @return GDO_User
	 */
	public function getCreator() { return $this->getValue('files_creator'); }
	public function getCreated() { return $this->getVar('files_created'); }
	public function getDescription() { return $this->getVar('files_description'); }
	public function hasDescription() { return !!$this->getVar('files_description'); }
	
	public function displayDate() { return tt($this->getCreated()); }
	public function displayDescription() { return $this->gdoColumn('files_description')->renderCell(); }
	
	##############
	### Render ###
	##############
	public function href_show() { return href('Gallery', 'Image', "&id={$this->getFileID()}&variant=thumb"); }
	public function href_full() { return href('Gallery', 'Image', "&id={$this->getFileID()}&nodisposition=1"); }
	
	public function renderCard()
	{
		return GDT_Template::php('Gallery', 'card/gallery_image.php', ['image' => $this]);
	}
}
