<?php
use GDO\Gallery\GDO_Gallery;
use GDO\UI\GDT_EditButton;
use GDO\UI\GDT_ListItem;
use GDO\UI\GDT_Button;
use GDO\User\GDO_User;
use GDO\UI\GDT_Title;
use GDO\UI\GDT_Paragraph;
use GDO\Avatar\GDT_Avatar;
/**
 * @var $gallery GDO_Gallery
 */
$gallery instanceof GDO_Gallery;

$li = GDT_ListItem::make();
$li->title(GDT_Title::make()->initial($gallery->getTitle()));
$subtitle = t('gallery_li2', [$gallery->getImageCount(), $gallery->getCreator()->displayName(), $gallery->displayDate()]);
$li->subtitle(GDT_Title::make()->initial($subtitle));
$li->subtext(GDT_Paragraph::make()->initial($gallery->displayDescription()));
$li->image(GDT_Avatar::make()->user($gallery->getCreator()));
$actions = $li->actions();
if ($gallery->canEdit(GDO_User::current()))
{
	$actions->addField(GDT_EditButton::make()->href(href('Gallery', 'Crud', "&id={$gallery->getID()}")));
}
$actions->addField(GDT_Button::make()->href($gallery->href_show())->icon('view')->label('btn_view'));
echo $li->render();
