<?php
# Imports
use GDO\UI\GDT_Card;
use GDO\UI\GDT_HTML;

# Variables
/** @var $image \GDO\Gallery\GDO_GalleryImage **/
$gallery = $image->getGallery();

# Title and creator
$card = GDT_Card::make()->addClass('gdo-gallery-image')->gdo($image);
$card->creatorHeader($gallery->gdoColumn('gallery_title'));

# Image content
$html = <<<EOF
<a href="{$image->href_full()}" target="_blank">
  <img src="{$image->href_show()}" alt="Gallery Image" />
</a>
EOF;
$card->addField(GDT_HTML::make()->html($html));

# Description footer
if ($image->hasDescription())
{
    $card->subtext($image->gdoColumn('gallery_description'));
}

# Render
echo $card->render();
