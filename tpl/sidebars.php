<?php
use GDO\Template\GDO_Bar;
use GDO\UI\GDO_Link;
use GDO\User\User;

$navbar instanceof GDO_Bar;
if ($navbar->isLeft())
{
    $navbar->addField(GDO_Link::make('link_gallery')->href(href('Gallery', 'List')));
    
}
elseif ($navbar->isRight())
{
    $user = User::current();
    $navbar->addField(GDO_Link::make()->href(href('Gallery', 'List', '&user='.$user->getID())));
}