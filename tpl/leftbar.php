<?php
use GDO\Template\GDO_Bar;
use GDO\UI\GDO_Link;
use GDO\User\User;
$navbar instanceof GDO_Bar;
$navbar->addField(GDO_Link::make('link_gallery')->href(href('Gallery', 'GalleryList')));