<?php get_header(); ?>
<!-- sub-container -->

<?php while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; // End the loop. Whew. ?>

<!-- sub-container end -->
<?php get_footer(); ?>
