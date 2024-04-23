<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>

<?php $url = $_SERVER['REQUEST_URI']; ?>
<?php if(is_front_page() && is_home()):?>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/tab.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/top.js"></script>

<?php elseif(get_post_type() == 'post' || get_query_var('post_type') == 'post' || $post_type == 'post'):?>
  <?php if(is_single()):?>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/libs/fancybox/jquery.fancybox.min.js"></script>
  <?php endif; ?>

<?php elseif(get_post_type() == 'column' || get_query_var('post_type') == 'column' || $post_type == 'column'):?>
  <?php if(is_single()):?>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/libs/fancybox/jquery.fancybox.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/tab.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/column-single.js"></script>
  <?php else: ?>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/tab.js"></script>
  <?php endif; ?>

<?php endif; ?>
<?php wp_footer();?>
</body>

</html>