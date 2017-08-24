<?php
namespace GDO\Gallery;

use GDO\Core\Module;
use GDO\Template\GDO_Bar;

final class Module_Gallery extends Module
{
    public function getClasses() { return ['GDO\Gallery\Gallery', 'GDO\Gallery\GalleryImage']; }
    public function onLoadLanguage() { $this->loadLanguage('lang/gallery'); }

    public function onRenderFor(GDO_Bar $navbar)
    {
        $this->templatePHP('sidebars.php', ['navbar'=>$navbar]);
      
    }
}
