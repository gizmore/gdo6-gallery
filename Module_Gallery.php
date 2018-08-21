<?php
namespace GDO\Gallery;

use GDO\Core\GDO_Module;
use GDO\UI\GDT_Bar;
use GDO\User\GDO_User;
use GDO\DB\GDT_Checkbox;

final class Module_Gallery extends GDO_Module
{
	public function getClasses() { return ['GDO\Gallery\GDO_Gallery', 'GDO\Gallery\GDO_GalleryImage']; }
	public function onLoadLanguage() { $this->loadLanguage('lang/gallery'); }
	
	public function getConfig()
	{
		return array(
			GDT_Checkbox::make('guest_galleries')->initial('1')->notNull(),
		);
	}
	public function cfgGuestGalleries() { return $this->getConfigValue('guest_galleries'); }

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
