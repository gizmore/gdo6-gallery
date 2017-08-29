<?php
use GDO\Gallery\Gallery;
use GDO\Gallery\GalleryImage;
use GDO\Table\GDT_List;
use GDO\Template\GDT_Bar;
use GDO\UI\GDT_Button;

$gallery instanceof Gallery;
?>
<?php 
$button = GDT_Button::make()->icon('add')->href(href('Gallery', 'Crud', "&id={$gallery->getID()}"));
$bar = GDT_Bar::make();
$bar->addField($button);
echo $bar->renderCell();

$images = GalleryImage::table();
$query = $images->select('*')->where("image_gallery={$gallery->getID()}");
$list = GDT_List::make();
$list->paginate();
$list->query($query);
echo $list->renderCell();
