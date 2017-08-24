<?php
use GDO\Avatar\Avatar;
use GDO\Gallery\Gallery;
use GDO\UI\GDO_EditButton;
use GDO\UI\GDO_Icon;
use GDO\User\User;
$gallery instanceof Gallery;
?>
<md-list-item class="md-2-line" href="<?= $gallery->href_show(); ?>">
	<?= Avatar::renderAvatar($gallery->getCreator()); ?>
  <div class="md-list-item-text" layout="column">
    <h2><?= html($gallery->getTitle()); ?></h2>
    <h3><?= t('gallery_li2', [$gallery->getImageCount(), $gallery->getCreator()->displayName(), $gallery->displayDate()]); ?></h3>
    <p><?= $gallery->displayDescription(); ?></p>
  </div>
  <?php if ($gallery->canEdit(User::current())) : ?>
    <?= GDO_EditButton::make()->href(href('Gallery', 'Crud', "&id={$gallery->getID()}"))?>
  <?php endif; ?>
  <?= GDO_Icon::iconS('arrow_right'); ?>
</md-list-item>
