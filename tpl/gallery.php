<?php
use GDO\Gallery\Gallery;
use GDO\Gallery\GalleryImage;
use GDO\Table\GDO_List;
use GDO\Template\GDO_Bar;
use GDO\UI\GDO_Button;

$gallery instanceof Gallery;
?>
<?php 
$button = GDO_Button::make()->icon('add')->href(href('Gallery', 'Crud', "&id={$gallery->getID()}"));
$bar = GDO_Bar::make();
$bar->addField($button);
echo $bar->renderCell();

$images = GalleryImage::table();
$query = $images->select('*')->where("image_gallery={$gallery->getID()}");
$list = GDO_List::make();
$list->paginate();
$list->query($query);
echo $list->renderCell();
