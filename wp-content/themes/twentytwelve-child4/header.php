<?php
// ----------------------------------------
// * 定数・パスインクルード
// ----------------------------------------

/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"><!-- font-awesome -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script><!--    -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/modal_01.css"><!--  モーダル01  -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/menu_01.css"><!--  menu01  -->
<!-- <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/menu_fixed.css">   menu固定  -->
<!-- reset CSS -->


<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>


<!-- slider_01 スライダー -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/slider_01/slider_01.js"></script><!-- slider_01 -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/slider_01/slider_01.css">






<!-- menu上部固定 -->
<script>
(function($) {
    $(function() {
        var $header = $('#masthead');
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $header.addClass('fixed');
            } else {
                $header.removeClass('fixed');
            }
        });
    });
})(jQuery);
</script>





<!-- TO TOP -->
<script type="text/javascript">
$(function() {
    var topBtn = $('#page-top');    
    topBtn.hide();
    //スクロールが100に達したらボタン表示
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
});
</script>

<!-- Fadein -->
<script type="text/javascript">
$(function(){
	//$('.fadeinlist').css("opacity","0");
    $(window).scroll(function (){
        $('.fadeinlist').each(function(){
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 200){
                $(this).addClass('scrollin');
            }else{
            	//$(this).addClass('scrollout');
            }
            if (scroll + windowHeight < elemPos){
                $(this).removeClass('scrollin');
            }
        });
    });
});
</script>

<!-- NEWSティッカー -->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/simpleTicker/jquery.simpleTicker.css" rel="stylesheet">
<script src="<?php echo get_stylesheet_directory_uri(); ?>/simpleTicker/jquery.simpleTicker.js"></script>
<script>
$(function(){
  //$.simpleTicker($("#ticker-fade"),{'effectType':'fade'});
 jQuery.simpleTicker($("#ticker-roll"),{'effectType':'roll'});
  //$.simpleTicker($("#ticker-slide"),{'effectType':'slide'});
});
</script>

	
	
<!-- ハンバーガーmenu -->
<script>
$(function() {
    $('.menu-trigger').click(function(){//headerに .openNav を付加・削除
        $('.menu-trigger').toggleClass('active');
        $('.nav-menu').toggleClass('toggled-active');
    });
});
</script>



<!-- モーダル -->
<script type="text/javascript">
$(function(){
//グローバル変数
var nowModalSyncer = null ;		//現在開かれているモーダルコンテンツ
var modalClassSyncer = "modal-syncer" ;		//モーダルを開くリンクに付けるクラス名

//モーダルのリンクを取得する
var modals = document.getElementsByClassName( modalClassSyncer ) ;

//モーダルウィンドウを出現させるクリックイベント
for(var i=0,l=modals.length; l>i; i++){

	//全てのリンクにタッチイベントを設定する
	modals[i].onclick = function(){

		//ボタンからフォーカスを外す
		this.blur() ;

		//ターゲットとなるコンテンツを確認
		var target = this.getAttribute( "data-target" ) ;

		//ターゲットが存在しなければ終了
		if( typeof( target )=="undefined" || !target || target==null ){
			return false ;
		}

		//コンテンツとなる要素を取得
		nowModalSyncer = document.getElementById( target ) ;

		//ターゲットが存在しなければ終了
		if( nowModalSyncer == null ){
			return false ;
		}

		//キーボード操作などにより、オーバーレイが多重起動するのを防止する
		if( $( "#modal-overlay" )[0] ) return false ;		//新しくモーダルウィンドウを起動しない
		//if($("#modal-overlay")[0]) $("#modal-overlay").remove() ;		//現在のモーダルウィンドウを削除して新しく起動する

		//オーバーレイを出現させる
		$( "body" ).append( '<div id="modal-overlay"></div>' ) ;
		$( "#modal-overlay" ).fadeIn( "fast" ) ;

		//コンテンツをセンタリングする
		centeringModalSyncer() ;

		//コンテンツをフェードインする
		$( nowModalSyncer ).fadeIn( "slow" ) ;

		//[#modal-overlay]、または[#modal-close]をクリックしたら…
		$( "#modal-overlay,#modal-close" ).unbind().click( function() {

			//[#modal-content]と[#modal-overlay]をフェードアウトした後に…
			$( "#" + target + ",#modal-overlay" ).fadeOut( "fast" , function() {

				//[#modal-overlay]を削除する
				$( '#modal-overlay' ).remove() ;

			} ) ;

			//現在のコンテンツ情報を削除
			nowModalSyncer = null ;

		} ) ;

	}

}
	//リサイズされたら、センタリングをする関数[centeringModalSyncer()]を実行する
	$( window ).resize( centeringModalSyncer ) ;

	//センタリングを実行する関数
	function centeringModalSyncer() {

		//モーダルウィンドウが開いてなければ終了
		if( nowModalSyncer == null ) return false ;

		//画面(ウィンドウ)の幅、高さを取得
		var w = $( window ).width() ;
		var h = $( window ).height() ;

		//コンテンツ(#modal-content)の幅、高さを取得
		// jQueryのバージョンによっては、引数[{margin:true}]を指定した時、不具合を起こします。
//		var cw = $( nowModalSyncer ).outerWidth( {margin:true} ) ;
//		var ch = $( nowModalSyncer ).outerHeight( {margin:true} ) ;
		var cw = $( nowModalSyncer ).outerWidth() ;
		var ch = $( nowModalSyncer ).outerHeight() ;

		//センタリングを実行する
		$( nowModalSyncer ).css( {"left": ((w - cw)/2) + "px","top": ((h - ch)/2) + "px"} ) ;

	}

} ) ;
</script>
<!-- モーダル END -->



</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<div class="inner c_wrap">
			<hgroup class="head_01">
				<div style="display:inline-block;"><!-- 電話転送（転送電話）での緊急電話の取りこぼしを防止します。 転送電話・ボイスワープ自動切り替えなら、転送録におまかせください。 -->
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
				<div style="display: inline-block;" class="login_btn_wrap">
					<div style="display: inline-block;display: none;"><!-- 検索フォーム  -->
						 <!-- <!-- 検索フォーム  -->
						<form role="search" method="get" action="<?php bloginfo('url'); ?>">
							<input type="text" name="s" id="s" value="" placeholder="検索">
							<!-- <input type="hidden" value="post" name="post_type" id="post_type">  --><!-- 投稿タイプを指定する場合-->
							<input type="submit" value="検索">
						</form>	
					</div>
					<!-- モーダル1  -->
					<div style="display: inline-block;">
						<div class="btn_01 btn_login">
						<a class="btn btn001 modal-syncer" data-target="modal-content-01" id="modal-open"><!--  モーダル01 -->
	<i class="fa fa-sign-in fa-lg" style="color:#FFF;vertical-align: top; padding-top: 1px; margin-right: 5px;"></i>ログイン</a></div>
					</div>
					<!-- モーダル2  -->
					<div style="display: inline-block;">
						<div class="btn_01 btn_login">
						<a class="btn btn001 modal-syncer coler_sinki" data-target="modal-content-02" id="modal-open"><i class="fa fa-user fa-lg" style="color:#FFF;vertical-align: top; padding-top: 1px; margin-right: 5px;"></i>会員登録</a></div>
					</div>

				</div>
			</hgroup>

			<hgroup class="head_02">
				<div class="header_logobox" style="">
					<div style="">
					    <h1 class="logo"  style="margin: 0;">
					    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					    		<img src="/wp-content/uploads/img/top_design3_sub_03_logo.png" style="" alt="<?php bloginfo( 'name' ); ?>" />
					    	</a>
					    </h1>
					</div>
				</div>

				<div style="">
					<!-- ハンバーガーmenu -->
					<div class="hamber">
						<!-- <a> → <span>に。Slim Stat Analytics使用だとaタグに余計な要素が追加されtoggleclassが効かなくなる為。 -->
						<span class="menu-trigger" >
							<span></span>
							<span></span>
							<span></span>
						</span>			
					</div>
					
			        <nav id="global-nav">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			        </nav>
				</div>
			</hgroup>

	    </div><!-- inner end -->
	</header><!-- #masthead -->


<!-- モーダル1 -->
<div id="modal-content-01">
  <h2 id="gm_sample_01" style="text-align: center;"><span>ログイン</span>
  </h2>
  <center>
    <div class="user_page-content2">
    
<form action="hoh_10so6_login.php" method="post" name="login_form2">
<div>
会員ID*<input type='text' name='id' id='id'>
</div>
<div>
パスワード*<input type='password' name='pw' id='pw'>
</div>
<div>
<input type='button' value='ログイン' onClick='login_ok();'>
</div>
</form>
<script type='text/javascript'>
function login_ok(){
	document.login_form2.submit();
}
login_org();
</script>
    
      <div style="text-align: center; display:none;">
    	<img src="/wp-content/uploads/img/common/icon_112460_256.png" style="width: 24px;" />
    
		<div class="" ><!-- www2用 -->
			<iframe src="/wp-content/themes/twentytwelve-child4/aws_trans.php" frameborder="0" 
			id="newsframe" 
		    style="border: 0; width: 100%; height: 100%; margin:0; padding: 0;" scrolling="yes" >
			</iframe>
		</div>    
			
			
		<div class="login_form_wrap" style="display:none;">
		<!--   <form action="https://192.168.2.5/10so6/partner/login/loginProc.php" method="post" name="login_form">  test   -->
		<form action="https://www2.10so6.com/login/loginProc.php" method="post" name="login_form"><!--     本番    -->
		<!-- <form action="/wp-content/themes/twentytwelve-child4/loginProc.php" method="post" name="login_form">    www2 不可   -->
			<!-- ログイン -->
			<div class="login-body">
			<div class="login-box">
			    <div class="loginLayout">
			        <div class="loginText">会員ID</div>
			        <div class="loginInput"><input type="text" name="userID" id="id_form"></div>
			    </div>
			    <div class="loginLayout">
			    <div class="loginText">パスワード</div>
			    <div class="loginInput"><input type="password" id="pw_form" name="userPW" onkeypress="enter()"></div>
			    </div>
			    <div class="loginButton">
			        <input type="submit" value="送信" />
			    </div>
		        <a href="/lostid">
					<div style=" font-size: 12px;  padding-top: 8px; height: 20px;" ><span class="arrow3" style="padding-bottom: 11px;"></span>ID/PWを忘れた方はこちらへ</div>
		        </a>
	
			</div>
		</form>
		</div><!-- login_form_wrap END -->
	
          <a class="btn btn004 button-link" id="modal-close"><img src="/wp-content/uploads/img/common/icon_batsu.png" style="width: 20px; vertical-align: middle;" />閉じる</a>
        </p>
      </div>
    </div>
  </center>
</div>	
	

<!-- モーダル2 --><!-- ※個別ページ/userregistform に変更 -->
<div id="modal-content-02">
  <h2 id="gm_sample_01" style="text-align: center;"><span>会員登録</span>
  </h2>
  <center>
    <div class="user_page-content2">
      <div style="text-align: center;">
<span style="
	background: #ff7800;
    padding: 5px 8px;
    /* text-decoration: underline; */
    color: #fff;
    border-radius: 5px;">メールアドレス確認</span> > お客様情報入力 > 入力内容確認 > 登録<br>
    	<img src="/wp-content/uploads/img/common/icon_119240_256.png" style="width: 34px;margin: 10px;" /><br>
ようこそ、電話活用達人！「転送録」へ <br>
<form action="https://www.10so6.com/" method="post" name="user_regist_form" id="userRegist"><!--  <?=WROOT_D?>wp-content/themes/twentytwelve-child4/userRegistForm.php  -->
<div style="
	text-align: left;
    width: 95%;
    margin: 10px auto;
    background: #ddd;
    padding: 10px;
    line-height: 20px;
    font-size: 13px;">
この度は 「転送録」にご関心をお寄せいただき、誠にありがとうございます。<br>
<input type="checkbox" name="confirm" value="1">
当社の <a href="http://www.widetec.com/privacy.php" target="_blank">個人情報保護方針について</a> と <a href="/tos" target="_blank">ご利用規約</a> にご同意いただき、チェックをお願いします。<br>
<!-- ※現行HPにてjavascriptチェックバリデーションをuserRegistForm.php(809)で行っている -->
</div>
<div style="
    width: 95%;
    margin: 10px auto;
    padding: 10px;
	text-align: left;
    font-size: 13px;">
下記にメールアドレスをご入力いただき、「送信する」ボタンをクリックしてください。<br>
ご入力いただいたメールアドレス宛てに、会員登録のご案内をお送りいたします。<br>
※ご案内メールが届かない場合は、メールアドレスのご入力に誤りがないかご確認ください。<br>
</div>
		<div class="login_form_wrap"><!-- login_form_wrap START -->
		<input type="hidden" name="common_menu" value="userRegistForm">
		<input type="hidden" name="mailcheck" value="1">
			<!-- ログイン -->
			<div class="login-body">
			<div class="login-box">
			    <div class="loginLayout">
			        <div class="loginText" style="margin-bottom: 10px;">メールアドレスのご確認</div>
			        <div class="loginInput"  style="margin-bottom: 10px;"><input type="text" name="email" id="id_form" style="width: 320px;"></div>
<div style="
    font-size: 11px;
	margin-bottom: 10px;">
		例）tensoroku@widetec.com<br>※携帯電話のメールアドレス、フリーメールアドレスはご遠慮ください
</div>
			    </div>
			    <div class="loginButton">
			        <input type="submit" value="送信" />
			    </div>
	
			</div>
		</div><!-- login_form_wrap END -->
</form>
          <a class="btn btn004 button-link" id="modal-close"><img src="/wp-content/uploads/img/common/icon_batsu.png" style="width: 20px; vertical-align: middle;" />閉じる</a>
        </p>
      </div>
    </div>
  </center>
</div>	
	



<!-- ご契約者謝意require -->
<!-- テーマディレクトリ内の○○.php をrequire -->
<?php //get_template_part( 'syai_define' ); ?><!-- 定義 -->
<?php //get_template_part( 'syai_dbconn' ); ?><!-- DB接続 -->
	
	
				
	<div id="main" class="wrapper">