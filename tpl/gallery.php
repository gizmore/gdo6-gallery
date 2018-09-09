<?php
use GDO\Gallery\GDO_Gallery;
use GDO\Gallery\GDO_GalleryImage;
use GDO\Table\GDT_List;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Button;
use GDO\User\GDO_User;

/** @var $gallery GDO_Gallery **/
$user = GDO_User::current();
?>
<?php
$bar = GDT_Bar::make();
if ($gallery->canEdit($user))
{
	$button = GDT_Button::make()->icon('edit')->label('btn_edit')->href(href('Gallery', 'Crud', "&id={$gallery->getID()}"));
	$bar->addField($button);
}
echo $bar->renderCell();
?>
<?php 
$images = GDO_GalleryImage::table();
$query = $images->select('*')->where("files_object={$gallery->getID()}")->joinObject('files_file');
$list = GDT_List::make();
$list->paginate();
$list->query($query);
echo $list->renderCell();
