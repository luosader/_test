
	$(function(){
		jQuery.fn.sub = function(){
			//获取值  serialize()提交表单数据  param()序列化  TP中$map['']=$_POST["param"]在接收端获取name相关值
			
			var str = $(".js").map(function(){
				return ($(this).attr("name")+"="+$(this).val());
			}).get().join("&");//map编辑内容 return返回数据 attr获取属性 val获取值 join插入一个连接符
			// 更为简单的写法$('#form').serialize();
			//简化了写法,相当于var mm1=$('n1').val();var ff=$('select').val();var mm2=$('#n2').val();var data="num1="+mm1+"fuhao="+ff+"&num2="+mm2;
			// 其它的 var data = {nu1:mm1,fu:ff,nu2:mm2};
			
			//alert(str);
			$.ajax({//ajax整体框架,from表中的提交按钮submit要换成button
				url:"calculator.php",//与此php页面沟通;from表中的action可删除,用不到
				type:"POST",//指明用POST方式与后台沟通
				// dataType:"json",//从php返回的值以JSON方式解释
				data:str,//要发送的数据

				//设置回调函数
				success:function(msg){//如果回调成功;msg是取calculator.php中的值,即后台传过来的值 
				$("span").text(msg);
				// $("span").html(msg);
				//alert(msg);
				}
				
				// success:function(json){//回调成功后执行
				// 	alert(json.str);//弹窗测试结果,显示所有值alert(json);
				// 	$("#result").html("计算结果："+json.str);//把php中返回值显示在预定义的result定位符位置
				// }
			});
		}
	})
/*
关于ajax 局部动态更新
	异步过程:获取数据->发送数据到处理文件->回调并显示结果
	data 如果有多个数据则用&连接，&符号起分隔作用
		例如var data = "title="+title+"&content="+cont;
	以POST方式发送的,不能用$_GET接收。在ajax中对from中的name重定义,优先级高,使name无效

除了ajax方式提交，还可以用$.post()或$.get()方式提交
	//$.post方式
	$('#test_post').mousedown(function(){
		$.post(
			'calculator.php',
			{
				num1:$('#num1').val(),
				num2:$('#num2').val(),
			},
			function(data){
				var myjson='';
				eval('myjson='+data+';');
				$('#result').html("数字1："+myjson.num1+"<br>数字2："+myjson.num2);
			}
		)
	})
*/