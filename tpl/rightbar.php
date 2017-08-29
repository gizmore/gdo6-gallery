<?php
use GDO\Template\GDT_Bar;
use GDO\UI\GDT_Link;
use GDO\User\User;
$navbar instanceof GDT_Bar;
$user = User::current();
$navbar->addField(GDT_Link::make()->href(href('Gallery', 'GalleryList', '&user='.$user->getID())));
