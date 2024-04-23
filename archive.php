<?php get_header(); ?>
<?php get_template_part('/inc/header'); ?>
<main id="page-top" class="page-news l-main bg-blue">
  <!-- hero -->
  <section id="hero" class="hero">
    <div class="hero__body">
      <p class="hero__en">NEWS</p>
      <?php if (is_year()): ?>
      <?php $year = get_the_date( 'Y' ); ?>
      <h1 class="hero__heading"><?php echo($year); ?>年のニュース</h1>
      <p class="hero__lead">LegulusGreenの<?php echo($year); ?>年の<br class="visible-sm">ニュースを掲載しています。</p>
      <?php else: ?>
      <h1 class="hero__heading">ニュース</h1>
      <p class="hero__lead">LegulusGreenの<br class="visible-sm">すべてのニュースを掲載しています。</p>
      <?php endif; ?>
    </div>
  </section>
  <!-- hero end -->
  <div class="breadcrumb">
    <div class="l-inner">
      <ul class="breadcrumb__list">
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="<?php echo home_url(); ?>/">TOP</a></li>
        <?php if (is_year()): ?>
        <li class="breadcrumb__item"><a href="<?php echo home_url(); ?>/news/" class="breadcrumb__anc">ニュース</a></li>
        <li class="breadcrumb__item"><?php echo($year); ?>年のニュース</li>
        <?php else: ?>
        <li class="breadcrumb__item">ニュース</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <div class="l-column">
    <div class="l-content">
      <?php
        $args= array(
          'post_type' => 'post',
          'paged' => $paged,
          'posts_per_page' => '12'
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