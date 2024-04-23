<div class="l-side side">
  <div class="side__block -all">
    <a class="sideList__anc" href="<?php echo home_url(); ?>/column/">すべて</a>
  </div>
  <?php
    $my_tax = 'column_category';
    $parent_terms = get_terms( $my_tax, array('hide_empty' => true, 'parent' => 0) );
    if(!empty($parent_terms)):
  ?>
  <dl class="side__block">
    <dt class="side__term">Category</dt>
    <dd class="side__desc">
      <?php
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
      ?>
    </dd>
  </dl>
  <?php endif; ?>
  <?php
    $year = NULL;
    $args = array(
      'post_type' => 'column',
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
          <a class="sideList__anc" href="<?= home_url(); ?>/<?= $year; ?>?post_type=column"><?= $year; ?>年</a>
        </li>
        <?php endif; ?>
        <?php endwhile; ?>
      </ul>
    </dd>
  </dl>
  <?php endif; wp_reset_query(); ?>
  <dl class="side__block -ranking">
    <dt class="side__term">Ranking</dt>
    <dd class="side__desc">
      <div class="side__ranking__tabs">
        <p class="side__ranking__tab -active" data-tab="ranking01">週間</p>
        <p class="side__ranking__tab" data-tab="ranking02">月間</p>
      </div>
      <div class="side__ranking">
        <?php 
          // $wpp_query_idsにランキング配列を格納
          if ( function_exists( 'wpp_get_mostpopular' ) ){
            $wpp_option = array( // ランキングの設定
              'range' => 'weekly',//集計期間。 daily, weekly, monthly, all のいずれかを指定
              'post_type' => 'column',//投稿タイプを選択
              'order_by' => 'views',
              'limit' => 5
            );
            $wpp_query = new \WordPressPopularPosts\Query( $wpp_option );
            $wpp_query_ids = array_map(
              function( $wppost ){
                return (int)$wppost->id;
              }, $wpp_query->get_posts()
            );
          }
        ?>
        <?php
          $wpp_args = array(
              'posts_per_page' => '5',
              'post_type' => 'column',
              'post__in' => $wpp_query_ids, // 先ほどのランキング配列を入れる
              'orderby' => 'post__in' // 配列の順番で表示する
          );
          $wpp_query = new WP_Query($wpp_args);
        ?>
        <?php if ($wpp_query->have_posts()) : ?>
        <div class="side__ranking__content" data-tab-content="ranking01">
          <?php while ($wpp_query->have_posts()) : $wpp_query->the_post(); ?>
          <?php
            $id = get_the_ID();
            $img = get_the_post_thumbnail_url($id, 'thumbnail');
            if (!$img) {
              $img = get_template_directory_uri() . "/assets/img/common/noimage-sm.jpg";
            }
            $title = wp_strip_all_tags(get_the_title());
            $count = 21;
            if(mb_strlen($title, 'UTF-8')>$count){
              $title = mb_substr($title, 0, $count, 'UTF-8');
              $title = $title.'...';
            }else{
              $title = $title;
            }
          ?>
          <div class="side__ranking__item">
            <a href="<?php the_permalink() ?>" class="side__ranking__link">
              <span class="no"></span>
              <div class="side__ranking__img">
                <img src="<?php echo esc_html($img); ?>" alt="<?php the_title(); ?>" width="90" height="60">
              </div>
              <div class="side__ranking__info">
                <p class="side__ranking__title"><?php echo($title); ?></p>
              </div>
            </a>
          </div>
          <?php endwhile; ?>
        </div>
        <?php endif; wp_reset_query(); ?>
        <?php 
          // $wpp_query_idsにランキング配列を格納
          if ( function_exists( 'wpp_get_mostpopular' ) ){
            $wpp_option = array( // ランキングの設定
              'range' => 'monthly',//集計期間。 daily, weekly, monthly, all のいずれかを指定
              'post_type' => 'column',//投稿タイプを選択
              'order_by' => 'views',
              'limit' => 5
            );
            $wpp_query = new \WordPressPopularPosts\Query( $wpp_option );
            $wpp_query_ids = array_map(
              function( $wppost ){
                return (int)$wppost->id;
              }, $wpp_query->get_posts()
            );
          }
        ?>
        <?php
          $wpp_args = array(
              'posts_per_page' => '5',
              'post_type' => 'column',
              'post__in' => $wpp_query_ids, // 先ほどのランキング配列を入れる
              'orderby' => 'post__in' // 配列の順番で表示する
          );
          $wpp_query = new WP_Query($wpp_args);
        ?>
        <?php if ($wpp_query->have_posts()) : ?>
        <div class="side__ranking__content" data-tab-content="ranking02">
          <?php while ($wpp_query->have_posts()) : $wpp_query->the_post(); ?>
          <?php
            $id = get_the_ID();
            $img = get_the_post_thumbnail_url($id, 'thumbnail');
            if (!$img) {
              $img = get_template_directory_uri() . "/assets/img/common/noimage-sm.jpg";
            }
            $title = wp_strip_all_tags(get_the_title());
            $count = 21;
            if(mb_strlen($title, 'UTF-8')>$count){
              $title = mb_substr($title, 0, $count, 'UTF-8');
              $title = $title.'...';
            }else{
              $title = $title;
            }
          ?>
          <div class="side__ranking__item">
            <a href="<?php the_permalink() ?>" class="side__ranking__link">
              <span class="no"></span>
              <div class="side__ranking__img">
                <img src="<?php echo esc_html($img); ?>" alt="<?php the_title(); ?>" width="90" height="60">
              </div>
              <div class="side__ranking__info">
                <p class="side__ranking__title"><?php echo($title); ?></p>
              </div>
            </a>
          </div>
          <?php endwhile; ?>
        </div>
        <?php endif; wp_reset_query(); ?>
      </div>
    </dd>
  </dl>
</div>