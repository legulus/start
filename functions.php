<?php
/**
 * @package WordPress
 */

// アイキャッチ画像を有効にする。
add_theme_support('post-thumbnails');

// 投稿スラッグ自動生成
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
  if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
    $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
  }
  return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );

add_filter('protected_title_format', 'remove_protected');
function remove_protected($title) {
  return '%s';
}

// 管理画面：投稿をニュースに変更
function custom_post_menu_label() {
	global $menu;
	global $submenu;
  $menu[5][0] = 'ニュース';
  $submenu['edit.php'][5][0] = 'ニュース一覧';
  $submenu['edit.php'][10][0] = '新しいニュース';
}
add_action('init', 'custom_post_object_label');

function custom_post_object_label() {
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'ニュース';
  $labels->singular_name = 'ニュース';
  $labels->add_new = _x('新規作成', 'ニュース');
  $labels->add_new_item = '新規追加';
  $labels->edit_item = 'ニュースの編集';
  $labels->new_item = '新規追加';
  $labels->view_item = 'ニュースを表示';
  $labels->search_items = 'ニュース検索';
  $labels->not_found = 'ニュースが見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱のニュースにも見つかりませんでした';
}
add_action('admin_menu', 'custom_post_menu_label');

// 投稿アーカイブ URL
function customPost_has_archive( $args, $post_type ) {
  if ( 'post' == $post_type ) {
      $args['rewrite'] = true;
      $args['has_archive'] = 'news';
  }
  return $args;
}
add_filter( 'register_post_type_args', 'customPost_has_archive', 10, 2 );
function customPost_permalink( $permalink ) {
  $permalink = '/news' . $permalink;
  return $permalink;
}
add_filter( 'pre_post_link', 'customPost_permalink' );
function customPost_rewrite_rules( $post_rewrite ) {
  $return_rule = array();
  foreach ( $post_rewrite as $regex => $rewrite ) {
      $return_rule['news/' . $regex] = $rewrite;
  }
  return $return_rule;
}
add_filter( 'post_rewrite_rules', 'customPost_rewrite_rules' );

///////////////////////////////////////////////////////////////////////////////
// カスタム投稿タイプを作成する(コラム)
add_action('init', 'add_column_post_type');
function add_column_post_type() {
  $params = array(
    'labels' => array(
      'name' => 'コラム'
    ),
    'public' => true,
    'menu_position' => 5,
    'has_archive' 	=> true,
    'menu_icon'     => 'dashicons-info-outline',
    'supports' 			=> array(
      'title',
      'thumbnail',
      'custom-fields',
      'author',
    ),
    'taxonomies' => array('column_category')
  );
  register_post_type('column', $params);
}
// カスタム投稿タイプ（column）用のカテゴリ（カテゴリ）を作成する
add_action('init', 'create_column_category_taxonomies');
function create_column_category_taxonomies() {
  // カテゴリを作成
  $labels = array(
    'name'                => 'カテゴリ'
  );
  $args = array(
    'hierarchical'        => true,
    'labels'              => $labels,
    'rewrite'             => array( 'slug' => 'column_category' )
  );
  register_taxonomy( 'column_category', 'column', $args );
}

///////////////////////////////////////////////////////////////////////////////
// カスタム投稿タイプを作成する(各種設定)
add_action('init', 'add_other_post_type');
function add_other_post_type() {
  $params = array(
    'labels' => array(
      'name' => '各種設定'
    ),
    'public' => true,
    'menu_position' => 5,
    'has_archive' 	=> true,
    'menu_icon'     => 'dashicons-deskother',
    'supports' 			=> array(
      'title',
      'thumbnail',
      'custom-fields',
    )
  );
  register_post_type('other', $params);
}

///////////////////////////////////////////////////////////////////////////////////////////////
// メニューの並び替え
function my_custom_menu_order($menu_order) {
  if (!$menu_order) return true;
  return array(
      'index.php', //ダッシュボード
      'separator1', //セパレータ１
      'edit.php', //投稿
      'edit.php?post_type=seminar',
      'edit.php?post_type=column',
      'edit.php?post_type=voices',
      'edit.php?post_type=sale',
      'edit.php?post_type=development',
      'edit.php?post_type=faq',
      'edit.php?post_type=staff',
      'edit.php?post_type=other',
      'separator2', //セパレータ２
      'edit.php?post_type=page', //固定ページ
      'users.php', //ユーザー
      'upload.php', //メディア
      'separator-last', //セパレータ
      'themes.php', //外観
      'plugins.php', //プラグイン
      'tools.php', //ツール
      'options-general.php', //設定
      'edit-comments.php', //コメント
  );
}
add_filter('custom_menu_order', 'my_custom_menu_order');
add_filter('menu_order', 'my_custom_menu_order');

///////////////////////////////////////////////////////////////////////////////////////////////
// 投稿画面から不要な機能を削除します。
function remove_post_supports() {
  remove_post_type_support('post','editor');
  // remove_post_type_support('page','editor');
}
add_action( 'init', 'remove_post_supports' );

///////////////////////////////////////////////////////////////////////////////////////////////
// 管理画面：カテゴリーの階層構造
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
    $args['checked_ontop'] = false;
    return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );

///////////////////////////////////////////////////////////////////////////////////////////////
// 記事が属する子タームを親タームのID順で並び替え
function cmp_parent( $a, $b ) {
  if ( $a->parent == $b->parent ) {
    return 0;
  }
  return ( $a->parent > $b->parent ) ? 1 : -1;
}
function my_child_categories(){
  global $wpdb;
  $child_ids = $wpdb->get_col("SELECT term_id FROM $wpdb->term_taxonomy WHERE parent>0");
  foreach($child_ids as $key => $child_id){
	$child = &get_category($child_id);
	echo '<li class="categoryLabel">'.$child->name.'</li>';
  }
}

///////////////////////////////////////////////////////////////////////////////////////////////
// wp_title()の日付アーカイブのタイトルを変更します。
function adjust_date_title( $title, $sep, $seplocation ) {
	$m        = get_query_var( 'm' );
	$year     = get_query_var( 'year' );
	$monthnum = get_query_var( 'monthnum' );
	$day      = get_query_var( 'day' );
	$date_title = '';

	// mパラメータがある場合 (パーマリンク設定がデフォルトの場合の日付アーカイブ)
	if ( is_archive() && ! empty( $m ) ) {
		$my_year  = substr( $m, 0, 4 );
		$my_month = substr( $m, 4, 2 );
		$my_day   = substr( $m, 6, 2 );
		$date_title    = $my_year . '年' . ( $my_month ? $my_month . '月' : '' ) . ( $my_day ? $my_day . '日' : '' );
	}
	// yearパラメータがある場合 (パーマリンク設定がデフォルト以外の日付アーカイブ)
	if ( is_archive() && ! empty( $year ) ) {
		$date_title = $year . '年';
		if ( ! empty( $monthnum ) ) {
			$date_title .= zeroise( $monthnum, 2 ) . '月';
		}
		if ( ! empty( $day ) ) {
			$date_title .= zeroise( $day, 2 ) . '日';
		}
	}
	// 日付調整を行ったタイトルがあれば区切り文字を追加(左か右)
	if ( '' != $date_title ) {
		if ( 'right' == $seplocation ) {
			$title = $date_title . " $sep ";
		} else {
			$title = " $sep " . $date_title;
		}
	}

	return $title;
}
add_filter( 'wp_title', 'adjust_date_title', 10, 3 );


///////////////////////////////////////////////////////////////////////////////////////////////
// ユーザープロフィールの不要な項目を非表示にする。
function user_profile_hide_style() {
  echo '<style>
  #your-profile .user-syntax-highlighting-wrap, /* シンタックスハイライト */
  #your-profile .user-admin-color-wrap, /* 管理画面の配色 */
  #your-profile .user-rich-editing-wrap, /* ビジュアルエディター */
  #your-profile .user-comment-shortcuts-wrap, /* キーボードショートカット */
  #your-profile .user-profile-picture, /* プロフィール写真 */
  #your-profile .user-sessions-wrap /* セッション */,
  #your-profile .user-description-wrap /* プロフィール情報 */ {
    display: none;
  }
  </style>'.PHP_EOL;
}
add_action('admin_print_styles', 'user_profile_hide_style');

///////////////////////////////////////////////////////////////////////////////////////////////
// previous_post_link() と next_post_link() にクラス付加
add_filter( 'previous_post_link', 'add_prev_post_link_class' );
function add_prev_post_link_class($output) {
	$replace = str_replace('<a href=', '<a class="singlePager__anc" href=', $output);
  return $replace;
}
add_filter( 'next_post_link', 'add_next_post_link_class' );
function add_next_post_link_class($output) {
	$replace = str_replace('<a href=', '<a class="singlePager__anc" href=', $output);
  return $replace;
}
///////////////////////////////////////////////////////////////////////////////////////////////
//ページネーション
function pagination($pages = '', $range = 2){
  $showitems = ($range * 1)+1;
  global $paged;
  if(empty($paged)) $paged = 1;
  if($pages == ''){
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages) {
      $pages = 1;
    }
  }
  if(1 != $pages) {
      echo '<ul class="pager">';
      if($paged > 1 && $showitems < $pages) echo '<li class="pager__item -prev"><a class="pager__both" href="'.get_pagenum_link($paged - 1).'"><span class="icon__arrow-left"></span></a></li>';
      for ($i=1; $i <= $pages; $i++){
        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
          echo ($paged == $i)? '<li class="pager__item"><span class="pager__anc is-current">'.$i.'</span></li>':'<li class="pager__item"><a class="pager__anc" href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
        }
      }
      if ($paged < $pages && $showitems < $pages) echo '<li class="pager__item -next"><a class="pager__both" href="'.get_pagenum_link($paged + 1).'"><span class="icon__arrow-right"></span></a></li>';
      echo '</ul>';
  }
}

///////////////////////////////////////////////////////////////////////////////////////////////
//親ページ・子ページ分岐
function is_parent_slug() {
    global $post;
    if ($post->post_parent) {
        $post_data = get_post($post->post_parent);
        return $post_data->post_name;
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////
// [homeurl]・・・ページ内リンクの記述に利用
// [tdir]・・・テーマファイル（親テーマ）内の画像を参照する時に利用
add_shortcode('homeurl', 'shortcode_url');
function shortcode_url() {
	return get_bloginfo('url');
}
add_shortcode('tdir', 'tmp_dir');
function tmp_dir() {
	return get_template_directory_uri();
}

///////////////////////////////////////////////////////////////////////////////////////////////
//スマートフォンを判別
//スマホ表示分岐(PC・タブレット or スマホ)
function is_mobile(){
  $useragents = array(
    'iPhone', // iPhone
    'iPod', // iPod touch
    'Android.*Mobile', // 1.5+ Android *** Only mobile
    'Windows.*Phone', // *** Windows Phone
    'dream', // Pre 1.5 Android
    'CUPCAKE', // 1.5+ Android
    'blackberry9500', // Storm
    'blackberry9530', // Storm
    'blackberry9520', // Storm v2
    'blackberry9550', // Storm v2
    'blackberry9800', // Torch
    'webOS', // Palm Pre Experimental
    'incognito', // Other iPhone browser
    'webmate' // Other iPhone browser
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
///////////////////////////////////////////////////////////////////////////////////////////////
// max画像サイズ
function otocon_resize_at_upload( $file ) {
	if ( $file['type'] == 'image/jpeg' OR $file['type'] == 'image/gif' OR $file['type'] == 'image/png') {
		$w = 1440;
		$h = 0;
		$image = wp_get_image_editor( $file['file'] );
		if ( ! is_wp_error( $image ) ){
			$size = getimagesize( $file['file'] );
			if ( $size[0] > $w || $size[1] > $h ){
				$image->resize( $w, $h, false );
				$final_image = $image->save( $file['file'] );
			}
		}
	}
	return $file;
}
add_action( 'wp_handle_upload', 'otocon_resize_at_upload' );
update_option( 'medium_large_size_w', 0 );
update_option( 'medium_crop',true );

///////////////////////////////////////////////////////////////////////////////////////////////
// サムネイル画像
add_image_size('thum_sm', 260, 260, true);
add_image_size('thum_vertical', 690, 426, true);

///////////////////////////////////////////////////////////////////////////////////////////////
// カテゴリーの説明文 pタグ除去
remove_filter('term_description','wpautop');
// 本文エリア pタグ除去
remove_filter('the_content', 'wpautop');

// SVGをアップロード可能に 
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

?>