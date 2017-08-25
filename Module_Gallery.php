<?php
namespace GDO\Gallery;

use GDO\Core\Module;
use GDO\Template\GDO_Bar;

final class Module_Gallery extends Module
{
    public function getClasses() { return ['GDO\Gallery\Gallery', 'GDO\Gallery\GalleryImage']; }
    public function onLoadLanguage() { $this->loadLanguage('lang/gallery'); }

    public function hookLeftBar(GDO_Bar $navbar)
    {
        $this->templatePHP('leftbar.php', ['navbar'=>$navbar]);
    }
    public function hookRightBar(GDO_Bar $navbar)
    {
        $this->templatePHP('rightbar.php', ['navbar'=>$navbar]);
    }
}
