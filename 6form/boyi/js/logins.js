function userLoginonee(){
	var uname = $('#username').val();	
	var password = $('#password').val();
	var yzm = $('#captcha').val();
	
	if(uname==""){
		$("#TSxian").html("璇峰～鍐欑敤鎴峰悕锛�")
		$("#username").focus();
		return false;
	}
	
	if(password==""){
		$("#TSxian").html("璇峰～鍐欏瘑鐮侊紒")
		$("#password").focus();
		return false;
	}
	/*if(yzm==""){
		$("#TSxian").html("璇峰～鍐欓獙璇佺爜锛�")
		$("#captcha").focus();
		return false;
	}*/
	$.ajax({
		url:'/user.php?act=act_ajax_login',
		type: 'POST',
		data:{'username':uname,'password':password,'captcha':yzm},
		success:function(data)
		{
			if(data == 1){
				$("#TSxian").html("璇峰～鍐欐纭殑楠岃瘉鐮侊紒");
				$("#captcha").focus();
				return false;
			}else if(data == 2){
				$("#TSxian").html("鐢ㄦ埛鍚嶆垨瀵嗙爜閿欒锛�");
				$("#username").focus();
				return false;
			}else{
				$("#TSxian").html("鐧诲綍鎴愬姛锛�");
				location.reload()
			}
		}
	});
}
function registeronetan(){
		var username = $('#username').val();	
		var yanzm = $('#yanzm').val();
		var password = $('#password').val();
		var confirm_password = $('#confirm_password').val();
		var yzm = $('#captcha').val();
		
		if(username==""){
			$("#TSxian").html("璇峰～鍐欐墜鏈哄彿锛�")
			$("#username").focus();
			return false;
		}else{
			reb=/(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
			if(username.match(reb)==null){
				$("#TSxian").html("鎮ㄥ～鍐欑殑鎵嬫満鍙锋牸寮忎笉姝ｇ‘锛�")
				$("#username").focus();
				return false;
			}
		}
		
		if(yanzm==""){
			$("#TSxian").html("璇峰～鍐欓獙璇佺爜锛�")
			$("#yanzm").focus();
			return false;
		}
		
		if(password==""){
			$("#TSxian").html("璇峰～鍐欏瘑鐮侊紒")
			if(password.length < 6){
				$("#TSxian").html("鐧诲綍瀵嗙爜涓嶈兘灏戜簬 6 涓瓧绗︼紒")
			}
			$("#password").focus();
			return false;
		} 
		if(confirm_password==""){
			$("#TSxian").html("璇峰～鍐欑‘璁ゅ瘑鐮侊紒")
			$("#confirm_password").focus();
			return false;	
		}
		if(password != confirm_password){
			$("#TSxian").html("涓ゆ杈撳叆瀵嗙爜涓嶄竴鑷达紒")
			$("#confirm_password").focus();
			return false;
		}
		$.ajax({
			url:'/user.php?act=is_registered',
			type: 'POST',
			data:{'username':username},
			success:function(data)
			{
				if(data == 'false'){
					$("#TSxian").html("璇ョ敤鎴峰悕宸插瓨鍦紒");
					$("#username").focus();
					return false;
				}else{
				$.ajax({
					url:'/user.php?act=act_ajax_register',
						type: 'POST',
						data:{'username':username,'password':password,'yanzm':yzm},
						success:function(data)
						{
							if(data == 1){
								$("#TSxian").html("璇峰～鍐欐纭殑鎵嬫満楠岃瘉鐮侊紒");
								$("#yanzm").focus();
								return false;
							}else if(data == 2){
								$("#TSxian").html("娉ㄥ唽澶辫触锛�");
								$("#username").focus();
								return false;
							}else{
								$("#TSxian").html("鎭枩鎮紝娉ㄥ唽鎴愬姛锛�");
								location.reload()
							}
						}
					});
				}
			}
		});
		_adwq.push([ 
		'_setAction','8lyao0',
		username //璇峰～鍏ユ敞鍐岀敤鎴峰悕 鎴� 娉ㄥ唽鐢ㄦ埛ID (璇峰己鍒惰浆鎹㈡垚瀛楃涓茬被鍨� )
		]); 
	}
	function get_mobile_codetan(){
		var username = $('#username').val();
		if(username==""){
			$("#TSxian").html("璇峰～鍐欐墜鏈哄彿锛�")
			$("#username").focus();
			return false;
		}else{
			reb=/(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
			if(username.match(reb)==null){
				$("#TSxian").html("鎮ㄥ～鍐欑殑鎵嬫満鍙锋牸寮忎笉姝ｇ‘锛�")
				$("#username").focus();
				return false;
			}else{
				$.ajax({
					url:'/user.php?act=is_registered',
					type: 'POST',
					data:{'username':username},
					success:function(data)
					{
						if(data == 'false'){
							$("#TSxian").html("璇ョ敤鎴峰悕宸插瓨鍦紒");
							$("#username").focus();
							return false;
						}else{
							$.ajax({
								url:'/user.php?act=send_codes',
								type: 'POST',
								data:{'username':username},
								success:function(data)
								{
									if(data){
										$.post('/sms.php', {mobile:jQuery.trim($('#username').val()),send_code:data}, function(msg) {
										$("#TSxian").html(jQuery.trim(unescape(msg)));
										if(msg=='鎻愪氦鎴愬姛'){
											$("#TSxian").html("楠岃瘉鐮佸凡鍙戦€佹敞鎰忔煡鏀讹紒");
											RemainTimetan();
										}
									});
									}
								}
							});
						}
					}
				});
			}
		}
		
        
	};
	var iTime = 59;
	var Account;
	function RemainTimetan(){
		document.getElementById('zphone').disabled = true;
		var iSecond,sSecond="",sTime="";
		if (iTime >= 0){
			iSecond = parseInt(iTime%60);
			iMinute = parseInt(iTime/60)
			if (iSecond >= 0){
				if(iMinute>0){
					sSecond = iMinute + "鍒�" + iSecond + "绉�";
				}else{
					sSecond = iSecond + "绉�";
				}
			}
			sTime=sSecond;
			if(iTime==0){
				clearTimeout(Account);
				sTime='鑾峰彇鎵嬫満楠岃瘉鐮�';
				iTime = 59;
				document.getElementById('zphone').disabled = false;
			}else{
				Account = setTimeout("RemainTimetan()",1000);
				iTime=iTime-1;
			}
		}else{
			sTime='娌℃湁鍊掕鏃�';
		}
		document.getElementById('zphone').value = sTime;
	}	