<?php
  $taxonomy = get_query_var( 'taxonomy' );
  $post_type = get_taxonomy( $taxonomy )->object_type[0];
  $term_object = get_queried_object();
  $term = get_term( $term_object->term_id, $taxonomy );

  if (get_post_type() == 'column' || get_query_var('post_type') == 'column' || $post_type == 'column') {
    get_template_part( 'template/post-column' , false );
    
  }
?>