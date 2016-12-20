<?php
//記事一覧を取得
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;  
	$limit = -1;//表示件数（default = -1）
	$cate_id = 0;//カテゴリID（default = 0）
	query_posts(  array (
	    'cat' => $cate_id,
	    'posts_per_page' => $limit,
	    'post_type' => 'post',
	    'order' => 'ASC',
	    'orderby' =>'menu_order',
	    'paged' => $paged ) );

	$list = ' ';   
	while ( have_posts() ) { the_post();
	    $list .= '<article class="listing-view clearfix" style="margin-bottom: 0; padding-bottom: 0;">'
	    . '<div class="listing-content">'
	    . '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>'
	    //. '<h4><a href="news_list_view.php?mypost='.$post->ID .'">' . get_the_title() . '</a></h4>'
	    //.'<p>' . get_the_excerpt() . '</p>'
	    //. '<a href="' . get_permalink() . '">' . '続きを読む &raquo;' . '</a>'
	    . '</div>'
	    . '</article>';
	}
	//return
	//'<div class="listings clearfix">'
	//. $list
	//. '<div class="nav-previous">' . get_next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts' ) ) . '</div>'
	//. '<div class="nav-next">' . get_previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>' ) ) . '</div>'
	//. '</div>' .
	wp_reset_query();

echo $list;

?>
