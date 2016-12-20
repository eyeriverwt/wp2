<?php
 
/* 必要な記述はここに追記していきます */
  
/* ---------------------------------------------------- */
/* 親テーマのCSSを読みこむ（@import 不要） */
/* ---------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
/* ---------------------------------------------------- */
/* 改行を<p>に変換するのを防ぐ */
/* ---------------------------------------------------- */
remove_filter( 'the_content', 'wpautop' );

/* ---------------------------------------------------- */
/* WordPress 4.2 絵文字機能を除去 */
/* ---------------------------------------------------- */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/*-------------------------------------------------*/
// * shortcode
//子テーマディレクトリにあるファイルを読み込む
// 書き方
// [inc file='ファイル名']
// ・news：通常投稿記事の一覧を表示（news.php）
// ・syai_list：転送録 謝意一覧を取得（syai_list.php）
// 
/*-------------------------------------------------*/
function inc_shortcode( $atts = array() ) {
	extract( shortcode_atts( array ('file' => 'default'), $atts ) );
    ob_start();
    get_template_part($file);//[inc file='ファイル名']
    return ob_get_clean();
}
add_shortcode('inc', 'inc_shortcode');

/*-------------------------------------------------*/
// * shortcode
//カスタム投稿タイプのタイプを指定して一覧を表示（件数指定可能）
//[feed type="faq" limit="5"]
/*-------------------------------------------------*/
function section_feed_shortcode( $atts ) {
	extract( shortcode_atts( array( 'limit' => -1, 'type' => 'post'), $atts ) );
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;  
	query_posts(  array (
	    'posts_per_page' => $limit,
	    'post_type' => $type,
	    'order' => 'ASC',
	    'orderby' =>'menu_order',
	    'paged' => $paged ) );

	$list = ' ';   
	while ( have_posts() ) { the_post();
	    $list .= '<article class="listing-view clearfix">'
	    . '<div class="listing-content">'
	    . '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'
	    .'<p>' . get_the_excerpt() . '</p>'
	    . '<a href="' . get_permalink() . '">' . '続きを読む &raquo;' . '</a>'
	    . '</div>'
	    . '</article>';
	}
	return
	'<div class="listings clearfix">'
	. $list
	. '<div class="nav-previous">' . get_next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts' ) ) . '</div>'
	. '<div class="nav-next">' . get_previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>' ) ) . '</div>'
	. '</div>' .
	wp_reset_query();
}
add_shortcode( 'feed', 'section_feed_shortcode' );

/* ---------------------------------------------------- */
/*  テスト環境などでのインストールディレクトリ取得ショートコード */
/* ---------------------------------------------------- */
function sitehome(){
    $wp_top = get_bloginfo('url');//テスト環境
    $sitehome = str_replace ('/10so6wp', '',$wp_top);
    //return $wp_top;
    return $sitehome;
}
add_shortcode('sitehome', 'sitehome');
// hoge はWordpress設置ディレクトリ
// http://www.○○○○○.com/hoge ←この部分
// 使用例
// <a href="http://[sitehome]">ホーム</a> 

/* ---------------------------------------------------- */
/*  スタイルシートとスクリプトの読み込みコードを関数にまとめる  */
/* ---------------------------------------------------- */
function my_scripts() {
	/*
	 * wp_enqueue_style() を使って style.css を登録・読み込みキューに追加。
	 * genericons という登録済みスタイルシートを依存指定し
	 * 自動的に style.css より先に読み込ませる。
	 */
	//wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri(), array( 'genericons' ) );
 
	/*
	 * wp_enqueue_script() を使って functions.js を登録・読み込みキューに追加。
	 * jquery を依存指定し自動的に先に読み込ませる。
	 * 20140319 というバージョン文字列を URL のクエリーストリングに付加し
	 * バージョンの異なるファイルキャッシュがある場合は更新されるようにする。
	 * スクリプトをフッターエリアで読み込ませる（多くの場合この設定が望ましい）。
	 */
	wp_enqueue_script( 'my-script', get_stylesheet_directory_uri() . '/js/myFunctions.js', array( 'jquery' ), '20140319', true );
}
// my_scripts() をサイト公開側で呼び出す。
add_action( 'wp_enqueue_scripts', 'my_scripts' );

/* ---------------------------------------------------- */
/*   */
/* ---------------------------------------------------- */








/* -(以下、未使用)-------------------------------------------------------------------------- */

/* ---------------------------------------------------- */
/* カスタムフィールドに[view]を追加し、表示ごとにインクリメント */
/* ---------------------------------------------------- */
function update_custom_meta_views() {
    global $post;
    if ('publish' === get_post_status($post) && is_single()) {
    $views = intval(get_post_meta($post->ID, '_custom_meta_views', true));
    update_post_meta($post->ID, '_custom_meta_views', ($views + 1));
    }
}
//add_action('wp_head', 'update_custom_meta_views');

/* 人気記事をソートして表示 */
function get_most_viewed() {
    $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'orderby' => 'meta_value_num',
    'meta_key' => '_custom_meta_views',
    'order' => 'DESC'
    );
    $posts = get_posts($args);
    $output = "<ul>¥n";
    foreach($posts as $post) {
    $output.= "<li>" . $post->post_title . " - " . $post->_custom_meta_views . "Views</li>n";
    }

    $output.= "</ul>n";
    echo $output;
}




?>