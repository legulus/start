<?php get_header(); ?>
<?php get_template_part('/inc/header'); ?>
<?php
	$taxonomy_slug = get_query_var('taxonomy');
	$taxonomy_var = get_taxonomy($taxonomy_slug);
?>
<main id="page-top" class="page-column l-main bg-blue">
  <!-- hero -->
  <section id="hero" class="hero">
    <div class="hero__body">
      <p class="hero__en">COLUMN</p>
      <h1 class="hero__heading"><?php single_cat_title() ?>に関するコラム</h1>
      <p class="hero__lead">LegulusGreenの<?php single_cat_title() ?>に関する<br class="visible-sm">コラムを掲載しています。</p>
    </div>
  </section>
  <!-- hero end -->
  <div class="breadcrumb">
    <div class="l-inner">
      <ul class="breadcrumb__list">
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="<?php echo home_url(); ?>/">TOP</a></li>
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="<?php echo home_url(); ?>/column/">コラム</a></li>
        <li class="breadcrumb__item"><?php single_cat_title() ?>に関するコラム</li>
      </ul>
    </div>
  </div>
  <div class="l-column">
    <div class="l-content">
      <?php
        $args= array(
          'post_type' => 'column',
          'paged' => $paged,
          'posts_per_page' => '9',
          'tax_query' => array(
            array(
              'taxonomy' => $taxonomy_var->name,
              'field' => 'slug',
              'terms' => $term
            ),
          )
        );
        $the_query = new WP_Query($args);
      ?>
      <?php if ($the_query->have_posts()) : ?>
      <ul class="columnItems">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php get_template_part('/template/parts/columnItem'); ?>
        <?php endwhile; ?>
      </ul>
      <?php if (function_exists("pagination")) { pagination($the_query->max_num_pages);} ?>
      <?php endif; wp_reset_postdata(); ?>
    </div>
    <?php get_template_part('/inc/side/side-column'); ?>
  </div>
</main>
<?php get_template_part('/inc/cv'); ?>
<?php get_template_part('/inc/footer'); ?>
<?php get_footer(); ?>