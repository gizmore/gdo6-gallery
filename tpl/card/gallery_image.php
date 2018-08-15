<?php
use GDO\Gallery\GDO_GalleryImage;
use GDO\User\GDO_User;
$image instanceof GDO_GalleryImage;
$user = GDO_User::current();
?>
<md-card class="gdo-gallery-image">
  <md-card-title>
	<md-card-title-text>
	  <span class="md-headline">
		<div>“<?= html($image->getDescription()); ?>”</div>
		<div class="gdo-card-date"><?= $image->displayDate(); ?></div>
	  </span>
	</md-card-title-text>
  </md-card-title>
  <gdo-div></gdo-div>
  <md-card-content flex>
	<img src="<?= $image->href_show(); ?>" />
  </md-card-content>
</md-card>
