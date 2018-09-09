<?php
namespace GDO\Gallery;

use GDO\Core\GDO_Module;
use GDO\UI\GDT_Bar;
use GDO\User\GDO_User;
use GDO\DB\GDT_Checkbox;
use GDO\Friends\GDT_ACL;
use GDO\User\GDO_UserSetting;

final class Module_Gallery extends GDO_Module
{
	##############
	### Module ###
	##############
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
		return GDO_UserSetting::userGet($user, 'gallery_acl');
	}
	
	public function canSeeGallery(GDO_User $user, GDO_User $target)
	{
		return $this->cfgUserACL($target)->hasAccess($user, $target);
	}
	
	#############
	### Hooks ###
	#############
	public function hookLeftBar(GDT_Bar $navbar)
	{
		$this->templatePHP('leftbar.php', ['navbar'=>$navbar]);
	}

	public function hookRightBar(GDT_Bar $navbar)
	{
		if (GDO_User::current()->isAuthenticated())
		{
			$this->templatePHP('rightbar.php', ['navbar'=>$navbar]);
		}
	}

}
