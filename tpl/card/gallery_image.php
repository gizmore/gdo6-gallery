<?php
use GDO\UI\GDT_Card;
use GDO\UI\GDT_Title;
use GDO\UI\GDT_HTML;

/** @var $image \GDO\Gallery\GDO_GalleryImage **/

$card = GDT_Card::make()->withCreated()->addClass('gdo-gallery-image')->gdo($image);

if ($image->hasDescription())
{
	$card->title(GDT_Title::make()->initial($image->displayDescription()));
}

$html = <<<EOF
<a href="{$image->href_full()}" target="_blank">
  <img src="{$image->href_show()}" alt="Image" />
</a>
EOF;

$card->addField(GDT_HTML::make()->html($html));

echo $card->render();
