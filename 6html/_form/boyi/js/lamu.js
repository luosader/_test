// JavaScript Document
$(document).ready(function(){

	$(".main_visual").hover(function(){
		$("#btn_prev,#btn_next").fadeIn()
	},function(){
		$("#btn_prev,#btn_next").fadeOut()
	});
	
	$dragBln = false;
	
	$(".main_image").touchSlider({
		flexible : true,
		speed : 200,
		btn_prev : $("#btn_prev"),
		btn_next : $("#btn_next"),
		paging : $(".flicking_con a"),
		counter : function (e){
			$(".flicking_con a").removeClass("on").eq(e.current-1).addClass("on");
		}
	});
	
	$(".main_image").bind("mousedown", function() {
		$dragBln = false;
	});
	
	$(".main_image").bind("dragstart", function() {
		$dragBln = true;
	});
	
	$(".main_image a").click(function(){
		if($dragBln) {
			return false;
		}
	});
	
	timer = setInterval(function(){
		$("#btn_next").click();
	}, 3000);
	
	$(".main_visual").hover(function(){
		clearInterval(timer);
	},function(){
		timer = setInterval(function(){
			$("#btn_next").click();
		},3000);
	});
	
	$(".main_image").bind("touchstart",function(){
		clearInterval(timer);
	}).bind("touchend", function(){
		timer = setInterval(function(){
			$("#btn_next").click();
		}, 3000);
	});
	
});
//悬浮
$(function(){
	$(".sy_xuanfu").hide();
$(".sy_xuanfu ul li").click(function(){
	var li = $(this);
	var xx =$(".sy_xuanfu").offset().top;
	$(".sy_xuanfu ul li.sy_xf_hover").removeClass("sy_xf_hover");
	li.addClass("sy_xf_hover");
	$(".foxff").each(function(){
		//左侧和右侧的标题一致
		if($.trim($(this).text()) == $.trim(li.text())){
			var h3 = $(this);
			var offset = h3.offset();
			var s= offset.top-280;
			//窗体滚动到点击的左侧对应的右侧,滚动时候暂停定时器，不然会导致乱
			window.clearInterval(itv);
			$("html,body").animate({scrollTop:s},"fast",function(){
				setin();
			});
			//$("body").scrollTop(offset.top);
		}
	});
});
 
});



