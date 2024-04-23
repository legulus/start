<?php get_header(); ?>
<?php get_template_part('/inc/header'); ?>
<main id="page-top" class="page-top l-main">
  <?php
    $args= array(
      'post_type' => 'column',
    );
    $the_query = new WP_Query($args);
  ?>
  <?php if ($the_query->have_posts()) : ?>
  <!-- column -->
  <section id="column" class="column bg-blue">
    <div class="l-inner">
      <div class="sec__head">
        <h2 class="sec__head__title">コラム</h2>
        <p class="sec__head__en">column</p>
        <p class="sec__lead">テストテスト</p>
      </div>
      <div class="sec__body">
        <div class="columnMain">
          <div class="columnFirst">
            <?php
              $args1= array(
                'post_type' => 'column',
                'posts_per_page' => '1',
              );
              $the_query1 = new WP_Query($args1);
            ?>
            <?php if ($the_query1->have_posts()) : ?>
            <?php while ($the_query1->have_posts()) : $the_query1->the_post(); ?>
            <?php
              $id = get_the_ID();
              $img = get_the_post_thumbnail_url($id, 'medium');
              if (!$img) {
                $img = get_template_directory_uri() . "/assets/img/common/noimage-md.jpg";
              }
              $title = wp_strip_all_tags(get_the_title());
              $count = 41;
              if(mb_strlen($title, 'UTF-8')>$count){
                $title = mb_substr($title, 0, $count, 'UTF-8');
                $title = $title.'...';
              }else{
                $title = $title;
              }
            ?>
            <a href="<?php the_permalink() ?>" class="columnFirst__link">
              <div class="columnFirst__img">
                <img src="<?php echo($img); ?>" alt="<?php echo($title); ?>" width="550" height="341">
              </div>
              <div class="columnFirst__info">
                <div class="column__features">
                  <p class="column__date"><?php the_time('Y.m.d'); ?></p>
                  <?php
                    $taxonomy = get_post_taxonomies($id);
                    $terms = get_the_terms($post->ID,$taxonomy[0]);
                    $cnt = 1;
                    if($terms){
                      echo '<ul class="category column__category">';
                      foreach ($terms as $cate){
                        $term_name = $cate->name;
                        $term_parent = $cate->parent;
                        if($cnt < 2){
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
                  <p class="columnFirst__title"><?php echo($title); ?></p>
                </div>
              </div>
            </a>
            <?php endwhile; ?>
            <?php endif; wp_reset_postdata(); ?>
          </div>
          <ul class="column__list">
            <?php
              $args2= array(
                'post_type' => 'column',
                'posts_per_page' => '3',
                'offset' => '1'
              );
              $the_query2 = new WP_Query($args2);
            ?>
            <?php if ($the_query2->have_posts()) : ?>
            <?php while ($the_query2->have_posts()) : $the_query2->the_post(); ?>
            <?php
              $id = get_the_ID();
              $img = get_the_post_thumbnail_url($id, 'medium');
              if (!$img) {
                $img = get_template_directory_uri() . "/assets/img/common/noimage-md.jpg";
              }
              $title = wp_strip_all_tags(get_the_title());
              $count = 41;
              if(mb_strlen($title, 'UTF-8')>$count){
                $title = mb_substr($title, 0, $count, 'UTF-8');
                $title = $title.'...';
              }else{
                $title = $title;
              }
            ?>
            <li class="column__item">
              <a href="<?php the_permalink() ?>" class="column__link">
                <div class="column__img">
                  <picture>
                    <source media="(max-width: 750px)" srcset="<?php echo($img); ?>" width="440" height="272">
                    <img src="<?php echo($img); ?>" alt="<?php echo($title); ?>" width="220" height="137">
                  </picture>
                </div>
                <div class="column__info">
                  <div class="column__features">
                    <p class="column__date"><?php the_time('Y.m.d'); ?></p>
                    <?php
                      $taxonomy = get_post_taxonomies($id);
                      $terms = get_the_terms($post->ID,$taxonomy[0]);
                      $cnt = 1;
                      if($terms){
                        echo '<ul class="category column__category">';
                        foreach ($terms as $cate){
                          $term_name = $cate->name;
                          $term_parent = $cate->parent;
                          if($cnt < 2){
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
                  <p class="column__title"><?php echo($title); ?></p>
                </div>
              </a>
            </li>
            <?php endwhile; ?>
            <?php endif; wp_reset_postdata(); ?>
          </ul>
        </div>
        <div class="content__btnarea">
          <a href="<?php echo home_url(); ?>/column/" class="btn -line -arrow">コラム一覧を見る</a>
        </div>
      </div>
    </div>
  </section>
  <!-- column end -->
  <?php endif; wp_reset_postdata(); ?>
  <?php
    $args= array(
      'post_type' => 'post',
      'posts_per_page' => '4',
    );
    $the_query = new WP_Query($args);
  ?>
  <?php if ($the_query->have_posts()) : ?>
  <!-- news -->
  <section id="news" class="news bg-blue">
    <div class="l-inner">
      <div class="sec__head">
        <h2 class="sec__head__title">ニュース</h2>
        <p class="sec__head__en">News</p>
      </div>
      <div class="sec__body">
        <ul class="articleFlat">
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <?php get_template_part('/template/parts/articleFlat-news'); ?>
          <?php endwhile; ?>
        </ul>
        <div class="content__btnarea">
          <a href="<?php echo home_url(); ?>/news/" class="btn -line -arrow">ニュース一覧を見る</a>
        </div>
      </div>
    </div>
  </section>
  <!-- news end -->
  <?php endif; wp_reset_postdata(); ?>
</main>
<?php get_template_part('/inc/footer'); ?>
<?php get_footer(); ?>