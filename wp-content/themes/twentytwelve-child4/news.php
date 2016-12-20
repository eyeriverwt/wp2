<?php
//記事一覧を取得
?>

<!-- カテゴリー=newsの記事を一覧表示(タイトルのみ) -->
<div style="background:#ddd;">
  <p>[inc file='news'] news.php :category_name=news</p>
  <?php $blog_posts = query_posts('category_name=news&showposts=5');
  foreach($blog_posts as $post): ?>
  <p><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></p>
  <?php endforeach; ?>
</div>
	  
<!-- 全ての記事を一覧表示(タイトルのみ) -->
<div style="background:#ccc;">
  <p>[inc file='news'] news.php :all</p>
  <?php $blog_posts = query_posts('showposts=5');
  foreach($blog_posts as $post): ?>
  <p><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></p>
  <?php endforeach; ?>
</div>