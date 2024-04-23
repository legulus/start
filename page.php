<?php $url = $_SERVER['REQUEST_URI']; ?>

<?php if(is_page('contact')):?>
<?php get_template_part('page/contact/index'); ?>

<?php elseif(is_parent_slug() == 'contact'): ?>
  <?php if(is_page('thanks')):?>
  <?php get_template_part('page/contact/thanks/index'); ?>
  <?php endif; ?>

<?php endif; ?>