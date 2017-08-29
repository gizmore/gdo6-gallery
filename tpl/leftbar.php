<?php
use GDO\Template\GDT_Bar;
use GDO\UI\GDT_Link;
use GDO\User\User;
$navbar instanceof GDT_Bar;
$navbar->addField(GDT_Link::make('link_gallery')->href(href('Gallery', 'GalleryList')));
