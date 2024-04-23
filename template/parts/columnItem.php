<?php
  $id = get_the_ID();
  $img = get_the_post_thumbnail_url($id, 'thumbnail');
  if (!$img) {
    $img = get_template_directory_uri() . "/assets/img/common/noimage-sm.jpg";
  }
?>
<li class="columnItem">
  <a class="columnItem__anc" href="<?php the_permalink() ?>">
    <div class="columnItem__head">
      <img src="<?php echo esc_html($img); ?>" alt="<?php the_title(); ?>" width="240" height="150" class="columnItem__img">
    </div>
    <div class="columnItem__body">
      <div class="columnItem__info">
        <p class="columnItem__date"><?php the_time('Y/m/d'); ?></p>
        <?php
          $taxonomy = get_post_taxonomies($id);
          $terms = get_the_terms($post->ID,$taxonomy[0]);
          $cnt = 1;
          if($terms){
            echo '<ul class="category columnItem__category">';
            foreach ($terms as $cate){
              $term_name = $cate->name;
              $term_parent = $cate->parent;
              if($cnt < 3){
                $catename = $term_name;
                if(mb_strlen($catename, 'UTF-8')>9){
                  $catename = mb_substr($catename, 0, 9, 'UTF-8');
                  $catename = $catename.'…';
                }else{
                  $catename = $catename;
                }
                echo '<li class="category__item"><span class="nolink">'.$catename.'</span></li>';
                $cnt++;
              }
            }
            echo '</ul>';
          }
        ?>
      </div>
      <p class="columnItem__title"><?php the_title(); ?></p>
      <?php if (get_field('lead')): ?>
      <?php
        $lead = strip_tags(get_field('lead'), '<strong>');
        if(mb_strlen($lead, 'UTF-8')>51){
          $lead = mb_substr($lead, 0, 51, 'UTF-8');
          $lead = $lead.'…';
        }else{
          $lead = $lead;
        }
      ?>
      <p class="columnItem__text"><?php echo($lead); ?></p>
      <?php endif; ?>
    </div>
  </a>
</li>