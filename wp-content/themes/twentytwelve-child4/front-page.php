<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>



<!-- POPUPバナー -->
<p id="popup-baner" style="font-size: 15px; display:none;">
		<a href="#">
		<img src="/wp-content/uploads/img/common/icon_125310_256_white.png" style="width: 24px; vertical-align: text-bottom; margin-right: 10px;">お問い合わせ</a>
</p>
	
<!-- POPUPバナー2 -->
	<p id="popup-baner2" style="font-size: 15px;display:none;">
		<a href="#">
		<img src="/wp-content/uploads/img/common/icon_125310_256_white.png" style="width: 24px; vertical-align: text-bottom; position: relative; top: 24%;"><br>
		<span>
		</span></a>
	</p>	


<!-- スライダー -->
	<div id="wide_slider" class="wide_slider_wrapper">
		<div class="wide_slider_wrap" style="">
			<div id="loading"><img src="/wp-content/uploads/img/common/gif-load_mono.gif" style="width: 50px;"></div>
			<div id="slideshow">
			   <ul>


			      <li style="background-size: cover;"><img src="/wp-content/uploads/img/slider_01.jpg" alt="">
					<div class="slider_text_wrap" style="top: 0;background:rgba(0, 0, 0, 0.5);">
						<div class="slider_text" style="margin:auto;margin-top:150px;">
							<span style="color:#71d3ff; ">「読む」「聴く」「感じる」を支援(サポート)するアイサポ</span><br>
							<div style="" class="slider_text01">

							</div>
							<div class="slider_disp2"></div>
						</div>
					</div>
				</li>

	
			      <li style="background-size: cover;"><img src="/wp-content/uploads/img/slider_01.jpg" alt="">
					<div class="slider_text_wrap" style="top: 0;background:rgba(0, 0, 0, 0.5);">
						<div class="slider_text" style="margin:auto;margin-top:80px;">
							<span style="color:#71d3ff; ">視覚障害・弱視者のアクティブライフを応援する<br>
							Androidタブレット端末<br></span><br>
							<div style="" class="slider_text01">
							
							</div>
							<div class="slider_disp2"></div>
						</div>
					</div>
				</li>

			   </ul>

			   <!-- スライダーボタン -->
			   <div id="slider_btn_prev" style=""><div class="slider_prevbtn_wrap"><div class="arrow01"></div></div></div>
    		   <div id="slider_btn_next" style=""><div class="slider_prevbtn_wrap"><div class="arrow02"></div></div></div>	
			</div><!-- /#slideshow -->	
    	</div>
				<!-- スライダーボタン -->
    			<div id="slider_btn_wrap" style=""></div>
	</div>





	<div id="primary" class="site-content">
		<div id="content" class="toppage" role="main">
<!-- パンくず -->
<div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
<!-- パンくず END -->
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
	
	
