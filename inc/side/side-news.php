<div class="l-side side">
  <div class="side__block -all">
    <a class="sideList__anc" href="<?php echo home_url(); ?>/news/">すべて</a>
  </div>
  <dl class="side__block">
    <dt class="side__term">Category</dt>
    <dd class="side__desc">
      <?php
        $my_tax = 'category';
        $parent_terms = get_terms( $my_tax, array('hide_empty' => true, 'parent' => 0) );
        if(!empty($parent_terms)):
          echo '<ul class="side__list">';
          foreach ( $parent_terms as $pt ) :
            $pt_id = $pt->term_id;
            $pt_name = $pt->name;
            $pt_url = get_term_link($pt);
      ?>
      <li class="sideList__item"><a href="<?php echo $pt_url; ?>" class="sideList__anc"><?php echo $pt_name; ?></a></li>
      <?php
        endforeach;
        echo '</ul>';
      endif;
      ?>
    </dd>
  </dl>
  <?php
    $year = NULL;
    $args = array(
      'post_type' => 'post',
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => -1
    );
    $the_query = new WP_Query($args);
  ?>
  <?php if ($the_query->have_posts()) : ?>
  <dl class="side__block">
    <dt class="side__term">Achive</dt>
    <dd class="side__desc">
      <ul class="sideList">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php if ($year != get_the_date('Y')) :
          $year = get_the_date('Y');
        ?>
        <li class="sideList__item">
          <a class="sideList__anc" href="<?= home_url(); ?>/<?= $year; ?>?post_type=post"><?= $year; ?>年</a>
        </li>
        <?php endif; ?>
        <?php endwhile; ?>
      </ul>
    </dd>
  </dl>
  <?php endif; wp_reset_query(); ?>
</div>