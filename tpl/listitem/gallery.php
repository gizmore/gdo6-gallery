<?php
use GDO\Avatar\GDO_Avatar;
use GDO\Gallery\GDO_Gallery;
use GDO\UI\GDT_EditButton;
use GDO\UI\GDT_Icon;
use GDO\User\GDO_User;
$gallery instanceof GDO_Gallery;
?>
<md-list-item class="md-2-line" href="<?= $gallery->href_show(); ?>">
	<?= GDO_Avatar::renderAvatar($gallery->getCreator()); ?>
  <div class="md-list-item-text" layout="column">
	<h2><?= html($gallery->getTitle()); ?></h2>
	<h3><?= t('gallery_li2', [$gallery->getImageCount(), $gallery->getCreator()->displayName(), $gallery->displayDate()]); ?></h3>
	<p><?= $gallery->displayDescription(); ?></p>
  </div>
  <?php if ($gallery->canEdit(GDO_User::current())) : ?>
	<?= GDT_EditButton::make()->href(href('Gallery', 'Crud', "&id={$gallery->getID()}"))->render(); ?>
  <?php endif; ?>
  
  <?= GDT_Icon::iconS('arrow_right'); ?>
</md-list-item>
