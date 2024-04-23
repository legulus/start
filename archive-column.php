<?php get_header(); ?>
<?php get_template_part('/inc/header'); ?>
<main id="page-top" class="page-column l-main bg-blue">
  <!-- hero -->
  <section id="hero" class="hero">
    <div class="hero__body">
      <p class="hero__en">COLUMN</p>
      <?php if (is_year()): ?>
      <?php $year = get_the_date( 'Y' ); ?>
      <h1 class="hero__heading"><?php echo($year); ?>年のコラム</h1>
      <p class="hero__lead">LegulusGreenの<?php echo($year); ?>年の<br class="visible-sm">コラムを掲載しています。</p>
      <?php else: ?>
      <h1 class="hero__heading">コラム</h1>
      <?php endif; ?>
    </div>
  </section>
  <!-- hero end -->
  <div class="breadcrumb">
    <div class="l-inner">
      <ul class="breadcrumb__list">
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="<?php echo home_url(); ?>/">TOP</a></li>
        <?php if (is_year()): ?>
        <li class="breadcrumb__item"><a href="<?php echo home_url(); ?>/column/" class="breadcrumb__anc">コラム</a></li>
        <li class="breadcrumb__item"><?php echo($year); ?>年のコラム</li>
        <?php else: ?>
        <li class="breadcrumb__item">コラム</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <div class="l-column">
    <div class="l-content">
      <?php
        $args= array(
          'post_type' => 'column',
          'paged' => $paged,
          'posts_per_page' => '9'
        );
        $year = get_the_date( 'Y' );
        if (is_year()):
          $args = array_merge(
            $args,
            array(
              'date_query' => array(
                array(
                  'year' => $year,
                ), 
              ),
            )
          );
        endif;
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
<?php get_template_part('/inc/footer'); ?>
<?php get_footer(); ?>