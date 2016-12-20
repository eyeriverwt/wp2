<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="inline_contents_wrap" style="border:0;margin-top:0;padding-top: 0; ">
		<div class="center_wrap">
		<div class="contents_wrap01" style="text-align:left; ">
		<div class="entry-header">
					<header>
						<?php echo get_the_date(); ?>
					</header>
		</div><!-- .entry-header -->
		<div class="entry-content" style="max-width: 80%; float:inherit; margin: 0 auto;">
			<div class="center_wrap">
			<div class="pan_wrap" style="margin-bottom:30px;">
			<div class="pan_01"><h1>コラム ></h1></div><div class="pan_02"><h1><?php the_title(); ?></h1></div>
			</div>		
			</div><!-- center_wrap END -->

			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta"  style="display:none;">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
			</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		</div><!-- contents_wrap01 END -->
		</div><!-- center_wrap END -->
		</div><!-- inline_contents_wrap END -->
	</article><!-- #post -->
