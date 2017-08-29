<?php
namespace GDO\Gallery;

use GDO\Core\GDO_Module;
use GDO\Template\GDT_Bar;

final class Module_Gallery extends GDO_Module
{
    public function getClasses() { return ['GDO\Gallery\GDO_Gallery', 'GDO\Gallery\GDO_GalleryImage']; }
    public function onLoadLanguage() { $this->loadLanguage('lang/gallery'); }

    public function hookLeftBar(GDT_Bar $navbar)
    {
        $this->templatePHP('leftbar.php', ['navbar'=>$navbar]);
    }
    public function hookRightBar(GDT_Bar $navbar)
    {
        $this->templatePHP('rightbar.php', ['navbar'=>$navbar]);
    }
}
