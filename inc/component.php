<?php if(get_post_type() == 'column' || get_query_var('post_type') == 'column' || $post_type == 'column'): ?>
  <?php
    $taxonomy_names = get_post_taxonomies();
    $terms = get_the_terms($post->ID,$taxonomy_names[0]);
    if($terms){
      foreach ( $terms as $term ) {
        if($term->parent == '0'){
          $oyaslug = $term->slug;
          break;
        }
      }
    }
  ?>
  <?php
    $topplus_id_prefix = 'toc-';
    $tocplus_id_num = 0;
    $tocplus_lv_num = [0,0,0];
    $tocplus_lv_current = 0;
    $tocplus_lv_before  = 0;
    $tocplus_html = '';
    if (have_rows('component')) {
      $tocplus_html .='<div class="component-toc">'."\n";
      $tocplus_html .='<dl class="toc">'."\n";
      $tocplus_html .='<dt class="toc__term"><span class="toc__term__main">目次</span></dt>'."\n";
      $tocplus_html .='<dd class="toc__desc">'."\n";
      $tocplus_html .='<ul class="toc__list">'."\n";
      while (have_rows('component')) {
        the_row();
        $tocplus_lv_current = 0;
        if( get_row_layout() == 'heading' ){
          switch (get_sub_field('heading_lebel')) {
            case '大': $tocplus_lv_current = 1; break;
          }
        }
        if (!$tocplus_lv_current) continue;
        if ($tocplus_lv_before != $tocplus_lv_current) {
          for ($i=$tocplus_lv_current+1; $i<=6; $i++) {
            $tocplus_lv_num[$i] = 0;
          }
        }
        $tocplus_lv_num[$tocplus_lv_current]++;
        $num = implode('-', array_filter($tocplus_lv_num, function($i){ return ($i === 0) ? false : true; }));
        if( get_row_layout() == 'heading' ){
          if(get_sub_field('heading_lebel') == '大') {
            $title = get_sub_field('heading_text');
            $tocplus_html .= '<li class="tocList__item"><a class="tocList__anc" href="#'.$topplus_id_prefix.$tocplus_id_num.'">'.$title.'</a></li>'."\n";
          }
        }
        $tocplus_lv_before = $tocplus_lv_current;
        $tocplus_id_num++;
      }
      $tocplus_html .= '</ul>'."\n";
      $tocplus_html .= '</dd>'."\n";
      $tocplus_html .= '</dl>'."\n";
      $tocplus_html .= '</div>'."\n";
      $cnt = 0;
      if (have_rows('component')) {
        while (have_rows('component')) {
          the_row();
          if($cnt < 1){
            if( get_row_layout() == 'heading' ){
              if(get_sub_field('heading_lebel') == '大') {
                echo $tocplus_html;
                $cnt++;
              }
            }
          }
        }
      }
    }
    $tocplus_id_num = 0;
  ?>
<?php endif; ?>
<?php if(have_rows('component')):?>
<?php while(have_rows('component')) : the_row();?>

  <?php if(get_row_layout() == 'heading'):?>
		<?php
      $level = get_sub_field('heading_lebel');
      if($level == '大'){
        $class = '-lg';
        $htag = 'h2';
      } elseif($level == '中'){
        $class = '-md';
        $htag = 'h3';
      } elseif($level == '小'){
        $class = '-sm';
        $htag = 'h4';
      }
      $heading = get_sub_field('heading_text');
    ?>
    <?php if(get_post_type() == 'column' || get_query_var('post_type') == 'column' || $post_type == 'column'): ?>
      <?php if($level == '大'): ?>
      <div class="componentheading<?php echo $class;?>">
        <<?php echo $htag;?> class="heading" id="<?php echo($topplus_id_prefix.$tocplus_id_num);$tocplus_id_num++; ?>"><?php echo $heading;?></<?php echo $htag;?>>
      </div>
      <?php else: ?>
      <div class="componentheading<?php echo $class;?>">
        <<?php echo $htag;?> class="heading"><?php echo $heading;?></<?php echo $htag;?>>
      </div>
      <?php endif; ?>
    <?php else: ?>
    <div class="componentheading<?php echo $class;?>">
      <<?php echo $htag;?> class="heading"><?php echo $heading;?></<?php echo $htag;?>>
    </div>
    <?php endif; ?>

  <?php elseif(get_row_layout() == 'text'):?>
		<?php
      $deco_frame = get_sub_field('line');
      $deco_bg = get_sub_field('background');
      $text = get_sub_field('text');
    ?>
    <div class="component-text<?php if($deco_frame){ echo ' -frame';};?><?php if($deco_bg){ echo ' -bg';};?>">
      <?php echo $text;?>
    </div>

  <?php elseif(get_row_layout() == 'image'):?>
    <?php
      $layout = get_sub_field('layout');
      $size = get_sub_field('size');
      if($size == '大'){
        $class = '-lg';
        $htag = 'h2';
      } elseif($size == '中'){
        $class = '-md';
        $htag = 'h3';
      } elseif($size == '小'){
        $class = '-sm';
        $htag = 'h4';
      }
    ?>
    <?php if($layout == '1カラム'):?>
      <?php if(have_rows('image')):?>
      <?php while(have_rows('image')): the_row();?>
        <?php
          $size = get_sub_field('size');
          if($size == '大'){
            $class = '';
            $sizeName = 'large';
          } elseif($size == '中'){
            $class = ' -md';
            $sizeName = 'medium';
          } elseif($size == '小'){
            $class = ' -sm';
            $sizeName = 'medium';
          } else {
            $sizeName = 'medium';
          }
          $img = get_sub_field('image');
          $caption = get_sub_field('caption');
        ?>
        <div class="component-img <?php if(isset($class)){ echo $class;}?>">
          <img src="<?php echo $img['sizes'][$sizeName];?>" alt="<?php echo $img['alt'];?>">
          <?php if($caption):?><p class="caption"><?php echo $caption;?></p><?php endif;?>
        </div>
      <?php endwhile;?>
      <?php endif;?>

    <?php elseif($layout == '2カラム'):?>
      <div class="component-img row">
      <?php if(have_rows('image')):?>
      <?php while(have_rows('image')): the_row();?>
        <?php
          $img = get_sub_field('image');
          $caption = get_sub_field('caption');
        ?>
        <div class="col-md item">
          <img src="<?php echo $img['sizes']['medium'];?>" alt="<?php echo $img['alt'];?>">
          <?php if($caption):?><p class="caption"><?php echo $caption;?></p><?php endif;?>
        </div>
      <?php endwhile;?>
      <?php endif;?>
      </div>

    <?php endif;?>

  <?php elseif(get_row_layout() == 'image-text'):?>
    <?php
      $layout = get_sub_field('layout');
      $class = '';
      if($layout == '左テキスト＋右画像'){
        $class = ' -rev';
      } else {
        $class = '';
      }
      $size = get_sub_field('size');
      if($size == '中'){
        $class_img = 'col-md';
        $class_text = 'col-md';
      } else {
        $class_img = 'col-sm';
        $class_text = 'col-lg';
      }
      $img = get_sub_field('image');
      $text = get_sub_field('text');
    ?>
    <div class="component-imgtext row<?php if(isset($class)){ echo $class;}?>">
      <div class="<?php echo $class_img;?> item">
        <img src="<?php echo $img['sizes']['medium'];?>" alt="<?php echo $img['alt'];?>">
      </div>
      <div class="<?php echo $class_text;?> item">
        <?php echo $text;?>
      </div>
    </div>

  <?php elseif(get_row_layout() == 'image-comment'):?>
    <?php
      $layout = get_sub_field('layout');
      if($layout == '左画像＋右吹き出し'){
        $class = ' -row';
      } elseif($layout == '左吹き出し＋右画像'){
        $class = ' -rev';
      }
      $color = get_sub_field('comment_color');
      if($color == 'グレー'){
        $class_color = ' -color01';
      } elseif($color == '色付き'){
        $class_color = ' -color02';
      }
      $img = get_sub_field('image');
      $name = get_sub_field('name');
      $text = get_sub_field('comment-text');
    ?>
    <div class="component-comment <?php echo $class;?> <?php echo $class_color;?>">
      <div class="comment__imgwrap">
        <div class="comment__img"><img src="<?php echo $img['sizes']['thum_sm'];?>" alt="<?php echo $img['alt'];?>"></div>
        <p class="comment__name"><?php echo $name;?></p>
      </div>
      <div class="comment__text"><div><?php echo $text;?></div></div>
    </div>

  <?php elseif(get_row_layout() == 'link_btn'):?>
    <?php
      $layout = get_sub_field('layout');
      if($layout == '1カラム'){
        $class = '-row1';
      } elseif($layout == '2カラム'){
        $class = 'row -row2';
      }
    ?>
    <div class="component-btn <?php echo $class;?>">
      <?php if(have_rows('link_btn')): ?>
      <?php while(have_rows('link_btn')): the_row(); ?>
        <?php
          $url = get_sub_field('link_url');
          $text = get_sub_field('link_btn_text');
          $blank = get_sub_field('new_window');
        ?>
        <div class="btn__link"><a class="btn -blue<?php if($blank){ echo' -blank';} else{echo' -arrow';}?>" href="<?php echo $url;?>"<?php if($blank){ echo'  target="_blank"';}?>><?php echo $text;?></a></div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>

  <?php elseif(get_row_layout() == 'movie'):?>
    <?php
      $movie = get_sub_field('movie');
      $caption = get_sub_field('caption');
      $size = get_sub_field('size');
      if($size == '大'){
        $class = '-lg';
      } elseif($size == '中') {
        $class = '-md';
      }
    ?>
    <div class="component-movie <?php if(isset($class)){ echo $class;}?>">
      <div class="movie__inner"><?php echo $movie;?></div>
      <?php if($caption):?><p class="caption"><?php echo $caption;?></p><?php endif;?>
    </div>

  <?php elseif(get_row_layout() == 'map'):?>
    <?php
      $movie = get_sub_field('map');
      $caption = get_sub_field('caption');
      $size = get_sub_field('size');
      if($size == '大'){
        $class = '-lg';
      } elseif($size == '中') {
        $class = '-md';
      }
    ?>
    <div class="component-map <?php if(isset($class)){ echo $class;}?>">
      <div class="map__inner"><?php echo $movie;?></div>
      <?php if($caption):?><p class="caption"><?php echo $caption;?></p><?php endif;?>
    </div>

  <?php elseif(get_row_layout() == 'relation'):?>
    <?php
      $relations = get_sub_field('relation');
      if($relations):
    ?>
    <?php foreach($relations as $relation):?>
    <?php
      $relation_id = $relation->ID;
      $img_size_pc = 'medium';
      $img_size_sp = 'medium';
      $img_pc = get_the_post_thumbnail_url($relation_id, $img_size_pc);
      $img_sp = get_the_post_thumbnail_url($relation_id, $img_size_sp);
      $title = get_the_title($relation_id);
      $leadText = get_field('lead',$relation_id);
      $lead = mb_strlen(get_field('lead',$relation_id),'UTF-8');
      if(wp_is_mobile()){
        $lead_count = '40';
      } else {
        $lead_count = '60';
      };
      if($lead > $lead_count){
        $lead = mb_substr(get_field('lead',$relation_id), 0, $lead_count, 'UTF-8');
        $leadText = $leadText.'…';
      };
      $directurl = get_field('directurl',$relation_id);
      $newwindow = get_field('newwindow',$relation_id);
      $blank = '';
      if($directurl) {
        $url = $directurl;
        if($newwindow) {
          $blank = ' target="_blank"';
        }
      } else {
        $url = get_permalink($relation_id);
      }
    ?>
    <div class="component-kanren row -frame">
      <?php if($img_pc): ?>
      <div class="col-sm item">
        <picture>
          <source media="(max-width: 750px)" srcset="<?php echo $img_sp; ?>">
          <img src="<?php echo $img_pc; ?>" alt="<?php echo $title;?>" loading="lazy">
        </picture>
      </div>
      <?php endif; ?>
      <?php if($img_pc): ?>
      <div class="col-lg item content">
      <?php else: ?>
      <div class="item content -noneImg">
      <?php endif; ?>
        <h3 class="heading"><?php echo $title;?></h3>
        <?php if($leadText):?>
          <p class="text"><?php echo $leadText;?></p>
        <?php endif;?>
        <div class="btnarea"><a href="<?php echo $url;?>"<?php echo($blank); ?> class="btn -blue -arrow -sm">詳しく見る</a></div>
      </div>
    </div>
    <?php endforeach;?>
    <?php endif;?>

  <?php elseif(get_row_layout() == 'gallery'):?>
    <div class="component-gallery">
      <div class="gallery__list">
        <?php while(have_rows('gallery')) : the_row();?>
          <?php
            $img = get_sub_field('image');
            if(wp_is_mobile()){
              $img_url = $img['sizes']['medium'];
            } else {
              $img_url = $img['sizes']['large'];
            }
            $size_pc = "full";
            $size_sp = "middle";
            $caption = get_sub_field('caption');
          ?>
          <a class="gallery__item" href="<?php echo $img_url;?>" data-fancybox="group" data-caption="<?php echo $caption;?>"><img src="<?php echo $img['sizes']['thum_sm'];?>" alt="<?php echo $img['alt'];?>"></a>
        <?php endwhile;?>
      </div>
      <?php if(wp_is_mobile()):?>
      <p class="caption">写真をタップすると拡大写真がみられます。</p>
      <?php else:?>
      <p class="caption">写真をクリックすると拡大写真がみられます。</p>
      <?php endif;?>
    </div>

  <?php elseif(get_row_layout() == 'table_2rows'):?>
    <?php
      $layout = get_sub_field('sp_size');
      if($layout == '大'){
        $class = ' -lg';
      } elseif($layout == '中'){
        $class = ' -md';
      } else {
        $class = '';
      }
    ?>
    <div class="component-table -col2">
      <table class="table<?php if(isset($class)){ echo $class;}?>">
        <?php if(have_rows('line')):?>
        <?php while(have_rows('line')): the_row();?>
        <?php
          $head = get_sub_field('table_heading');
          $desc = get_sub_field('table_content');
        ?>
        <tr>
          <th><?php echo $head;?></th>
          <td><?php echo $desc;?></td>
        </tr>
        <?php endwhile;?>
        <?php endif;?>
      </table>
    </div>

  <?php elseif(get_row_layout() == 'table_free'):?>
    <?php
      $layout = get_sub_field('sp_size');
      if($layout == '大'){
        $class = ' -lg';
      } elseif($layout == '中'){
        $class = ' -md';
      } else {
        $class = '';
      }
    ?>
    <div class="component-table -free">
      <table class="table<?php if(isset($class)){ echo $class;}?>">
      <?php
        $table = get_sub_field('table');
        if($table){
          if($table['header'] ){
            echo '<thead>';
              echo '<tr>';
                foreach ($table['header'] as $th){
                  echo '<th>';
                  echo $th['c'];
                  echo '</th>';
                }
              echo '</tr>';
            echo '</thead>';
          }
          echo '<tbody>';
            foreach ($table['body'] as $tr){
              echo '<tr>';
                foreach ( $tr as $td ){
                  echo '<td>';
                    echo $td['c'];
                  echo '</td>';
                }
              echo '</tr>';
            }
          echo '</tbody>';
        }
      ?>
      </table>
    </div>

<?php endif; ?>

<?php endwhile;?>
<?php endif;?>