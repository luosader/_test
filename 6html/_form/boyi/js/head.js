// JavaScript Document
//广告位
function target_dis(){
var target=document.getElementById("TT_ggw");
target.style.display="none";
}

//下拉效果
//$(document).ready(function(){
//    $(".TT_nav01 span").mousemove(function(){
//		$(".TT_nav03").slideDown().mouseleave(function(){
//			$(this).slideUp()
//		})
//	})
//});

//20150903新添加的下拉效果
//下拉效果
$(document).ready(function(){
//    nav-li hover e
    var num;
    $('.TT_nav01 span').hover(function(){
       /*图标向上旋转*/
        $(".TT_nav01 span").addClass('hover');
        /*下拉框出现*/
        var Obj = $(this).attr('id');
        num = Obj.substring(3, Obj.length);
        $('#nav_box').slideDown(200);
    },function(){
        /*下拉框消失*/
        $('#nav_box').hide();
    });
//    hidden-box hover e
    $('.TT_nav03').hover(function(){
        /*保持图标向上*/
        $(".TT_nav01 span").addClass('hover');
        $(this).show();
    },function(){
        $(this).slideUp(300);
        $(".TT_nav01 span").removeClass()
    });
});
 function hd_close_(){
    //alert("aaa");
    hd_tc.style.display = 'none';  
          hd_tc.style.display = 'none';  

  };
//======yibo dsp ==========
var _adwq = _adwq || [];
  _adwq.push(['_setAccount', 'yhd6i']);
  _adwq.push(['_setDomainName', '.tata.com.cn']);
  _adwq.push(['_trackPageview']);
 
(function() { 
var adw = document.createElement('script'); 
adw.type = 'text/javascript'; 
adw.async = true; 
adw.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://s') + '.emarbox.com/js/adw.js'; 
var s = document.getElementsByTagName('script')[0]; 
s.parentNode.insertBefore(adw, s); 
})(); 