<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="padding-bottom: 0px;">

		<div class="entry-header" style="display:none;">
			<header>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
			</header>
		</div><!-- .entry-header -->

		<div class="entry-content">
			<!-- ぱんくず -->
			<div class="inline_contents_wrap" style="">
			<div class="center_wrap pankuzu" style="text-align: left;">
			<a href="//www2.10so6.com/">TOP</a> &gt; <strong><a href="https://www2.10so6.com/column">コラム</a> &gt; <?php the_title(); ?></strong>
			</div><!-- center_wrap END -->
			</div>

			<div class="inline_contents_wrap headline01" style="">
			<div class="center_wrap" style="text-align: center;">
			<h1 class="inquiry_banner" style="padding-top: 30px;font-weight: bold;font-size: 30px ;"><span><?php the_title(); ?></span></h1>
			<p></p>
			</div><!-- center_wrap END -->
			</div><!-- inline_contents_wrap END -->		

		<div style="background: #f7f7f7; padding-top: 20px; padding-bottom: 20px;">
		<div class="colums_wrap02">
				<div class="column_status_text_wrap">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
				</div><!-- column_status_text_wrap END -->	
		</div><!-- colums_wrap02 END -->
		</div>
			
		</div><!-- .entry-content -->


		<footer class="entry-meta">
			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
			</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->


	</article><!-- #post -->
