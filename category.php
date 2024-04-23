<?php get_header(); ?>
<?php get_template_part('/inc/header'); ?>
<main id="page-top" class="page-news l-main bg-blue">
  <!-- hero -->
  <section id="hero" class="hero">
    <div class="hero__body">
      <p class="hero__en">NEWS</p>
      <h1 class="hero__heading"><?php wp_title(''); ?>に関するニュース</h1>
      <p class="hero__lead">LegulusGreenの<?php wp_title(''); ?>に関する<br class="visible-sm">ニュースを掲載しています。</p>
    </div>
  </section>
  <!-- hero end -->
  <div class="breadcrumb">
    <div class="l-inner">
      <ul class="breadcrumb__list">
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="<?php echo home_url(); ?>/">TOP</a></li>
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="<?php echo home_url(); ?>/news/">ニュース</a></li>
        <li class="breadcrumb__item"><?php wp_title(''); ?>に関するニュース</li>
      </ul>
    </div>
  </div>
  <div class="l-column">
    <div class="l-content">
      <?php
        $cat_info = get_category($cat);
        $args= array(
          'post_type' => 'post',
          'cat' => $cat_info->cat_ID,
          'paged' => $paged,
          'posts_per_page' => '12',
          'order'=>'DESC',
          'orderby'=>'post_date'
        );
        $the_query = new WP_Query($args);
      ?>
      <?php if ($the_query->have_posts()) : ?>
      <ul class="articleFlat">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php get_template_part('/template/parts/articleFlat-news'); ?>
        <?php endwhile; ?>
      </ul>
      <?php if (function_exists("pagination")) { pagination($the_query->max_num_pages);} ?>
      <?php endif; wp_reset_postdata(); ?>
    </div>
    <?php get_template_part('/inc/side/side-news'); ?>
  </div>
</main>
<?php get_template_part('/inc/cv'); ?>
<?php get_template_part('/inc/footer'); ?>
<?php get_footer(); ?>