<?php
  $id = get_the_ID();
  $directurl = get_field('directurl');
  $newwindow = get_field('newwindow');
  $blank = '';
  if($directurl) {
    $pageUrl = $directurl;
    if($newwindow) {
      $blank = ' target="_blank"';
    }
  } else {
    $pageUrl = get_permalink();
  }
?>
<li class="articleFlat__item">
  <a class="articleFlat__anc" href="<?php echo($pageUrl); ?>"<?php echo($blank); ?>>
    <div class="articleFlat__head">
      <p class="articleFlat__date"><?php the_time('Y/m/d'); ?></p>
      <?php
        $taxonomy = get_post_taxonomies($id);
        $terms = get_the_terms($post->ID,$taxonomy[0]);
        $cnt = 1;
        if($terms){
          echo '<ul class="category articleFlat__category">';
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
      <ul class="category articleFlat__category">
      </ul>
    </div>
    <h3 class="articleFlat__title"><?php the_title(); ?></h3>
  </a>
</li>