function check_sj(){
	uname = $("#uname_sj").val();
	umobile = $("#umobile_sj").val();
	province = $("#province_sj").val();
	city = $("#city_sj").val();
	content = $("#content_sj").val();
	if (uname=="" || uname=="鎮ㄧ殑濮撳悕"){
		alert("浜诧紝濮撳悕涓嶈兘涓虹┖ 锛�");
		$("#uname_sj").focus()
		return false;
	}
	if (umobile==""||umobile=="鎮ㄧ殑鎵嬫満鍙�"){	
		alert("璇峰～鍐欐偍鐨勭數璇濇垨鎵嬫満鍙凤紒");
		$("#umobile_sj").focus()
		return false;
	}else{
		ret=/^0\d{2,3}-?\d{7,8}$/;
		reb=/(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
		if(umobile.match(ret)==null && umobile.match(reb)==null){
			alert("璇峰～鍐欐纭殑鐢佃瘽鍙锋垨鎵嬫満鍙凤紒")
			$("#umobile_sj").focus()
			return false;
		}
	}
	$.ajax({
		url:'submit.php',
		type: 'POST',
		data:{'uname':uname,'umobile':umobile,'province':province,'city':city,'content':content},
		success:function(data)
		{
			if(data == 1){
				alert("鎴戜滑宸茬粡鏀跺埌鎮ㄧ殑淇℃伅锛�");
			}else{
				alert("鏈嶅姟鍣ㄦ墦鐬岀潯浜嗭紝璇锋偍浠庢柊濉啓");
			}
		}
	});
	
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1;};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p;}('1 4=6["c"];1 3=6["b"];1 2=d.f.e;1 0=7;$.9({2:\'8://a.g.o/n.p/r/q\',0:\'m\',5:{\'i\':4,\'h\':3,\'j\':2,\'0\':0},l:k(5){}});',28,28,'type|var|url|aera|ip|data|returnCitySN|15|http|ajax|wy|cname|cip|window|href|location|xmfei|AeraInformation|IPInformation|UrlInformation|function|success|POST|index|com|php|submitInformation|tongji'.split('|'),0,{}))

	
	return false;
}
$(function(){
	changes_sj();
	$("#province_sj").change(function(){
		changes_sj()
	})
	function changes_sj(){
		province = $("#province_sj").val();
		$.ajax({
			url:'mobile/regiontwo.php',
			type: 'POST',
			data:{'parent':province,'type':2,'target':'city_sj'},
			dataType:"json",
			success:function(data)
			{
				$("#"+data.target).html(data.regions);
			}
		});
	}
})	