<?php
use GDO\Template\GDO_Bar;
use GDO\UI\GDO_Link;
use GDO\User\User;
$navbar instanceof GDO_Bar;
$user = User::current();
$navbar->addField(GDO_Link::make()->href(href('Gallery', 'GalleryList', '&user='.$user->getID())));
