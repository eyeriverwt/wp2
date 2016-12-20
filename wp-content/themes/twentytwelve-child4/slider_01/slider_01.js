/**
 *  slider_01
 *
 *  背景固定スライダー（ボタン付）
 *  
 *  autoChange({effect : 'fade',type : 'repeat',timeout: 3000,speed : 800,slidebtn : 0});//slidebtn = 1 :表示、0:非表示
 *  @param {string} effect (fade,slide)
 *  @param {string} type (repeat,stop)
 *  @param {integer} timeout (単位ミリ秒（ms))  //1秒 = 1000
 *  @param {integer} speed (単位ミリ秒（ms) or 'slow' 'normal' 'fast' )
 *  @param {integer} slidebtn ( 0 or 1 ) // previous next ボタン default=1 表示 0:非表示
 *  @return { } ( )
 *  @throws {Error} ( )
 */

//$(function () {
  // ここに読み込み完了時に実行してほしい内容を書く。
//});	
//(function($) {
//  $.fn.rotateColors = function(colors) {
//    return this.each(function(i, elem) {
      // TODO : write codes.
//    });
//  };
//}(jQuery));

(function($) {
    $.fn.autoChange = function(config) {
    	$('#slideshow').fadeIn(800);//一瞬表示されてしまうスライダーをフェードイン表示
    	$('#loading').hide();// loadingを非表示に
    
       // オプション
       var options = $.extend({
          effect  : 'fade',
          type    : 'repaet',
          timeout : 1000,
          speed   : 500,
          slidebtn : 1//default=1 表示 0:非表示
       }, config);

       return this.each(function() {// -------------------------
    
            // カウンター初期化
            var current = 0;
            var next = 1;
            var i = 0;
            
            // 指定した要素の子要素を取得
            var element = $(this).children();
            
            // 要素を非表示にする
            $(element).hide();
            // 最初の要素を表示にする
            $(element[0]).show();
            
            // img要素を非表示にする
            $('img', element).hide();
            
            // 画像パス取得・背景画像としてセット
            for (i=0; i < element.length; i++) {
             var src = [];
             src[i] = $('img', element[i]).attr('src');
             $(element[i]).css('background-image','url('+src[i]+')');
            }

            // btn SET
            for (i=0; i < element.length; i++) {
            	//var div_element = document.createElement("button");
            	var div_element = document.createElement("div");
            	div_element.setAttribute("style","display: inline-block; margin-left:10px; cursor: pointer;");
            	div_element.setAttribute("class","slider_btn");
            	div_element.setAttribute("value", i );
            	div_element.setAttribute("onclick","slider_btn");
            
                div_element.innerHTML = '●';
                var parent_object = document.getElementById("slider_btn_wrap");
                parent_object.appendChild(div_element);
            }
            if (options.slidebtn == 0) {
                $('#slider_btn_prev').css('display','none');
                $('#slider_btn_next').css('display','none');
            }
            
            // 要素の横幅をセット
            elementWidth();
            
            // ウィンドウをリサイズしたときに要素の横幅を再計算
            $(window).resize(function() {
                elementWidth();
            });
            
            // 要素の横幅をウィンドウサイズに合わせる
            function elementWidth() {
                var windowWidth = $(window).width();
                element.css('width',windowWidth);
            }
            
            // 要素を切り替えるスクリプト------------------------
            var change = function(){
                //console.log("[1]change :current:" + current +"   next:" + next);
                // フェードしながら切り替える場合
                if (options.effect == 'fade') {
                    $(element[current]).fadeOut(options.speed);
                    //$(element[next]).setAttribute("class","active_btn");
                    $(".slider_btn").eq([current]).removeClass("active_btn");
                    $(".slider_btn").eq([next]).addClass("active_btn");
                    
                    $(element[next]).fadeIn(options.speed);
                
                // スライドしながら切り替える場合
                } else if  (options.effect == 'slide') {
                    $(element[current]).slideUp(options.speed);
                    $(element[next]).slideDown(options.speed);
                }
                
                // リピートする場合
                if (options.type == 'repeat') {
                    if ((next + 1) < element.length) {
                        current = next;
                        next++;
                    } else {
                        current = element.length - 1;
                        next = 0;
                    }
                }
                //console.log("[2]change :current:" + current +"   next:" + next);// debug     
                // 最後の要素でストップする場合
                if (options.type == 'stop') {
                    if ((next + 1) < element.length) {
                        current = next;
                        next++;
                    } else {
                        return;
                    }
                }
            };// change END-------------------------------------

            // 設定時間毎にスクリプトを実行
            //var timer = setInterval(function(){change();}, options.timeout);
            //var loopSwitch = setInterval(loop, _timer);
            var loopSwitch = setInterval(function(){change();}, options.timeout);
            //function loop() {
            //    imageMove(_current +1);
            //}
        
            // btn click イベント ------------------------------------
            $('.slider_btn').on('click' , function(){
        		//alert(current);// debug    
                var clickVal = parseInt($(this).attr("value"));
        		//	console.log("click");// debug    
                //console.log("current:" + current +"   next:" + next +"   click:" + clickVal);// debug    
        		    $(element[current]).hide();
                    $(element[clickVal]).show();//現在のimgを変更
                    $(".slider_btn").eq([current]).removeClass("active_btn");
                    $(".slider_btn").eq([clickVal]).addClass("active_btn");
                    //next SET
                    current = clickVal;
                    next = parseInt(clickVal +1);
                    if (next >= parseInt(element.length)) {
                        //current = element.length - 1;
                        next = 0;
                    }
                //ループ時間リセット   
                clearInterval(loopSwitch);
                loopSwitch = setInterval(function(){change();}, options.timeout);   
                //console.log("current:" + current +"   next:" + next +"   click:" + clickVal +"   elementlength" +element.length);// debug    
                //console.log("click_END---------");// debug    
            });
            $('#slider_btn_prev').on('click' , function(){
                if (current == 0) {
                    next = element.length-1;
                }else {
                    next = parseInt(current -1);
                }
                $(element[current]).hide();
                $(element[next]).show();//現在のimgを変更
                $(".slider_btn").eq([current]).removeClass("active_btn");
                $(".slider_btn").eq([next]).addClass("active_btn"); 
                //next SET
                current = next;
                next = parseInt(current +1);
                if (next >= parseInt(element.length)) {
                    //current = element.length - 1;
                    next = 0;
                }
                //ループ時間リセット   
                clearInterval(loopSwitch);
                loopSwitch = setInterval(function(){change();}, options.timeout);                 
            });
            $('#slider_btn_next').on('click' , function(){
                if (current >= parseInt(element.length)) {
                    next = 0;
                }
                $(element[current]).hide();
                $(element[next]).show();//現在のimgを変更
                $(".slider_btn").eq([current]).removeClass("active_btn");
                $(".slider_btn").eq([next]).addClass("active_btn"); 
                //next SET
                current = next;
                next = parseInt(current +1);
                if (next >= parseInt(element.length)) {
                    //current = element.length - 1;
                    next = 0;
                }
                //ループ時間リセット   
                clearInterval(loopSwitch);
                loopSwitch = setInterval(function(){change();}, options.timeout);                 
            });
            // click END-------------------------------------
            
       });//return this.each END---------------------------------------------------
    
    };//autoChange END------------------------------------------------------------------



    // 自動切り替えする要素の設定
    $(function() {
       $('#slideshow ul').autoChange({effect : 'fade',type : 'repeat',timeout: 3000,speed : 800,slidebtn : 0});//slidebtn = 1 :表示、0:非表示
    });  

}(jQuery));      
  
  


