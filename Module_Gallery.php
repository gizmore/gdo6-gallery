<?php
namespace GDO\Gallery;

use GDO\Core\GDO_Module;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Link;
use GDO\User\GDO_User;
use GDO\DB\GDT_Checkbox;
use GDO\Friends\GDT_ACL;
use GDO\Core\GDO;

final class Module_Gallery extends GDO_Module
{
	##############
	### Module ###
	##############
	public function getDependencies() { return ['File']; }
	public function getClasses() { return ['GDO\Gallery\GDO_Gallery', 'GDO\Gallery\GDO_GalleryImage']; }
	public function onLoadLanguage() { $this->loadLanguage('lang/gallery'); }
	
	##############
	### Config ###
	##############
	public function getConfig()
	{
		return array(
			GDT_Checkbox::make('guest_galleries')->initial('1')->notNull(),
		);
	}
	public function cfgGuestGalleries() { return $this->getConfigValue('guest_galleries'); }

	public function getUserSettings()
	{
		return array(
			GDT_ACL::make('gallery_acl')->initial('acl_all'),
		);
	}
	
	###########
	### ACL ###
	###########
	/**
	 * @param GDO_User $user
	 * @return GDT_ACL
	 */
	public function cfgUserACL(GDO_User $user)
	{
		return Module_Gallery::instance()->userSetting($user, 'gallery_acl');
	}
	
	public function canSeeGallery(GDO_User $user, GDO_Gallery $gallery, &$reason)
	{
		return $gallery->aclColumn()->hasAccess($user, $gallery->getCreator(), $reason);
	}
	
	public function canAddGallery(GDO_User $user)
	{
		if ($user->isMember())
		{
			return true;
		}
		return $this->cfgGuestGalleries();
	}
	
	#############
	### Hooks ###
	#############
	public function hookLeftBar(GDT_Bar $navbar)
	{
	    $navbar->addField(GDT_Link::make('link_gallery')->href(href('Gallery', 'GalleryList')));
	}

	public function hookRightBar(GDT_Bar $navbar)
	{
	    $user = GDO_User::current();
		if ($user->isAuthenticated())
		{
		    $navbar->addField(GDT_Link::make('link_your_gallery')->href(href('Gallery', 'GalleryList', '&user='.$user->getID())));
		}
	}
	
	public function hookUserSettingChange(GDO_User $user, $key, $value)
	{
		if ($key === 'gallery_acl')
		{
			$this->changeAllGalleryACL($user, $value);
		}
	}
	
	/**
	 * Update all user galleries when main acl is changed.
	 * @param GDO_User $user
	 * @param string $value
	 */
	private function changeAllGalleryACL(GDO_User $user, $value)
	{
		GDO_Gallery::table()->update()->
			set('gallery_acl='.GDO::quoteS($value))->
			where('gallery_creator='.$user->getID())->
			exec();
	}
	

}
