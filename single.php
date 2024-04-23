<?php get_header(); ?>
<?php get_template_part('/inc/header'); ?>
<?php
	$taxonomy_names = get_post_taxonomies();
	$terms = get_the_terms($post->ID,$taxonomy_names[0]);
	$postid = $post->ID;
  $title = get_the_title();
  $title_striptag = strip_tags($title);
	if($terms){
		foreach ( $terms as $term ) {
      $oyaname = $term->name;
      $oyaslug = $term->slug;
      $oyaid = $term->term_id;
      break;
		}
	}
	$rand_terms = get_the_terms($post->ID,$taxonomy_names[0]);
	if($rand_terms){
		foreach ( $rand_terms as $randterm ) {
      $randcate = $randterm->slug;
      break;
		}
	}
?>
<main class="l-main page-news bg-blue">
  <div class="breadcrumb">
    <div class="l-inner">
      <ul class="breadcrumb__list">
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="/">TOP</a></li>
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="<?php echo home_url(); ?>/news/">ニュース</a></li>
        <?php if($oyaname != ''){ echo '<li class="breadcrumb__item"><a class="breadcrumb__anc" href="'.home_url().'/category/'.$oyaslug.'">'.$oyaname.'に関するニュース</a></li>';} ?>
				<li class="breadcrumb__item"><?php echo $title_striptag; ?></li>
      </ul>
    </div>
  </div>
  <div class="l-column">
    <div class="l-content-sm">
      <div class="single__head">
        <div class="slngle__info">
          <p class="single__day"><?php the_time('Y.m.d'); ?></p>
					<?php
						$taxonomy_slug = 'category';
						$category_terms = wp_get_object_terms($post->ID, $taxonomy_slug);
						if(!empty($tag_terms) || !empty($category_terms)){
							echo '<ul class="single__category category">';
							if(!is_wp_error($category_terms)){
								foreach($category_terms as $category_term){
									echo '<li class="category__item"><a class="link" href="'.get_term_link($category_term->slug, $taxonomy_slug).'">'.$category_term->name.'</a></li>';
								}
							}
							echo '</ul>';
						}
					?>
        </div>
        <h1 class="single__title"><?php echo $title; ?></h1>
      </div>
      <div class="single__body">
        <?php get_template_part('/inc/component'); ?>
				<ul class="singlePager">
					<li class="singlePager__item -left"><?php if (get_previous_post()) {previous_post_link('%link','前の記事'); } ?></li>
					<li class="singlePager__item -center"><a class="singlePager__anc" href="<?php echo home_url(); ?>/news/">記事一覧</a></li>
					<li class="singlePager__item -right"><?php if (get_next_post()) {next_post_link('%link','次の記事'); } ?></li>
				</ul>
      </div>
    </div>
    <?php get_template_part('/inc/side/side-news'); ?>
  </div>
</main>
<?php get_template_part('/inc/cv'); ?>
<?php get_template_part('/inc/footer'); ?>
<?php get_footer(); ?>