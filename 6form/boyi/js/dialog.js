/**
 * 
 *鍗婇€忔槑 寮圭獥 鑷€傚簲
 */

  var mask=document.getElementById('mask');  
  var layer = document.getElementById('layer');  
  function show(id,addid){
           // for IE 6  
           if(document.uniqueID && !window.XMLHttpRequest){  
               document.getElementsByTagName('html')[0].style.overflow = 'hidden';  
            }  
          mask.style.display = 'block';  
          layer.style.display = 'block';  
            // js 鑾峰彇楂樺害   
            var bd = layer.firstChild, h;  

            if(bd.nodeType==3)bd = bd.nextSibling;  
            //h = bd.clientHeight;  
            //bd.style.height = h + 'px';  
             bd.style.width=$("#"+id+"").css("width");//document.getElementById(id).style.width;//document.getElementById(id).offsetWidth;//鐢╦s绉嶆柟寮忎笌闂锛屾敼鐢╦q鏉ヨ幏鍙朾d鐨勫搴︼紱
           h=$("#"+id+"").css("height");
          bd.style.height=h;//杩欓噷鐨刪鏄�500px  甯︽湁鍗曚綅 鏄釜瀛楃涓诧紝鐩存帴/2鏄疦aN   涓庝箣鍓嶇殑js鏂规硶涓嶄竴鏍�
          var _marginTop = (-parseFloat(h))/2;
            bd.style.marginTop = _marginTop+"px" ;  
            bd.innerHTML=document.getElementById(id).innerHTML;
		$("#addressid").val(addid);

            
  }
  
  function close_(){
    //alert("aaa");
    mask.style.display = 'none';  
          layer.style.display = 'none';  

  }
  var jilu = 0;
  function sendd(){
		addid = $("#addressid").val();
		umobile = $("#umobile").val();
		if(umobile==""){
			alert("璇峰～鍐欐墜鏈哄彿锛�")
			$("#umobile").focus();
			return false;
		}else{
			reb=/(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
			if(umobile.match(reb)==null){
				alert("鎮ㄥ～鍐欑殑鎵嬫満鍙锋牸寮忎笉姝ｇ‘锛�")
				$("#umobile").focus();
				return false;
			}
		}
		if(jilu == addid){
			$("#fs_submit").html("鍙戦€佷腑");
			return false;
		}
		jilu = addid;
		$.ajax({
			type: "POST",
			url: "/experience.php",
			data:"mobile="+umobile+"&addid="+addid+"&type=fs_add",
			success: function(data){
				if(data=='鎻愪氦鎴愬姛'){
					alert("鍦板潃宸插彂閫佹敞鎰忔煡鏀讹紒");
					mask.style.display = 'none';  
					layer.style.display = 'none'; 
					$("#addressid").val();
					$("#umobile").val();
				}else{
					alert("鏈嶅姟鍣ㄧ潯鐫€浜嗭紝绋嶅悗鍐嶈瘯锛�");
					mask.style.display = 'none';  
					layer.style.display = 'none'; 
					$("#addressid").val();
					$("#umobile").val();
				}
				jilu = 0;
			}
		});
	}

  $(function(){
	var city = $("#city").val();
	var district = 0;
	$.ajax({
		type: "POST",
		url: "/experience.php",
		data:"city="+city+"&type=district",
		success: function(data){
			$("#district").html("");
			$("#district").append(data);
		}
	});
	setBusiness1(1,city,district);
	$("#pageNav1").delegate("a","click",function(){
		city = $("#city").val();
		district = $("#district").val();
		var page = $(this).data("currpage");
		setBusiness1(page,city,district);
	});
	
	$("#city").change(function(){
		city = $("#city").val();
		district = 0;
		$.ajax({
			type: "POST",
			url: "/experience.php",
			data:"city="+city+"&type=district",
			success: function(data){
				$("#district").html("");
				$("#district").append(data);
			}
		});
		setBusiness1(1,city,district);
	})
	$("#district").change(function(){
		city = $("#city").val();
		district = $("#district").val();
		setBusiness1(1,city,district);
	})
	$("#TT_tiyandian_general").delegate("a","click",function(){
		var city = $(this).data("city");
		var district = $(this).data("district");
		$.ajax({
			type: "POST",
			url: "/experience.php",
			data:"city="+city+"&district="+district+"&type=all",
			dataType:"json",
			success: function(data){
				$("#district").html("");
				$("#district").append(data.district);
				$("#city").html("");
				$("#city").append(data.city);
			}
		});
		setBusiness1(1,city,district);
	});
	function setBusiness1(page,city,district){
		$.ajax({
			type: "POST",
			url: "/experience.php",
			data:"city="+city+"&district="+district+"&page="+page+"&type=ajax",
			dataType:"json",
			success: function(data){
				$("#xianshi").html("");
				$("#xianshi").append(data.content);
				$('#maxPage1').val(data.count);
				$('#num1').val(data.pages);
				var maxPage = $('#maxPage1').val();
				if(page == 1){
					if($("#num1").val()>1){
						pageNav1.go(page,$("#num1").val(),'pageNav1');
					}else{
						$("#pageNav1").html("");
					}	
				}
			}
		});
	}
	
	
})
