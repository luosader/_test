
	$(function(){
		jQuery.fn.sub = function(){
			//��ȡֵ  serialize()�ύ������  param()���л�  TP��$map['']=$_POST["param"]�ڽ��ն˻�ȡname���ֵ
			
			var str = $(".js").map(function(){
				return ($(this).attr("name")+"="+$(this).val());
			}).get().join("&");//map�༭���� return�������� attr��ȡ���� val��ȡֵ join����һ�����ӷ�
			// ��Ϊ�򵥵�д��$('#form').serialize();
			//����д��,�൱��var mm1=$('n1').val();var ff=$('select').val();var mm2=$('#n2').val();var data="num1="+mm1+"fuhao="+ff+"&num2="+mm2;
			// ������ var data = {nu1:mm1,fu:ff,nu2:mm2};
			
			//alert(str);
			$.ajax({//ajax������,from���е��ύ��ťsubmitҪ����button
				url:"calculator.php",//���phpҳ�湵ͨ;from���е�action��ɾ��,�ò���
				type:"POST",//ָ����POST��ʽ���̨��ͨ
				// dataType:"json",//��php���ص�ֵ��JSON��ʽ����
				data:str,//Ҫ���͵�����

				//���ûص�����
				success:function(msg){//����ص��ɹ�;msg��ȡcalculator.php�е�ֵ,����̨��������ֵ 
				$("span").text(msg);
				// $("span").html(msg);
				//alert(msg);
				}
				
				// success:function(json){//�ص��ɹ���ִ��
				// 	alert(json.str);//�������Խ��,��ʾ����ֵalert(json);
				// 	$("#result").html("��������"+json.str);//��php�з���ֵ��ʾ��Ԥ�����result��λ��λ��
				// }
			});
		}
	})
/*
����ajax �ֲ���̬����
	�첽����:��ȡ����->�������ݵ������ļ�->�ص�����ʾ���
	data ����ж����������&���ӣ�&������ָ�����
		����var data = "title="+title+"&content="+cont;
	��POST��ʽ���͵�,������$_GET���ա���ajax�ж�from�е�name�ض���,���ȼ���,ʹname��Ч

����ajax��ʽ�ύ����������$.post()��$.get()��ʽ�ύ
	//$.post��ʽ
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
				$('#result').html("����1��"+myjson.num1+"<br>����2��"+myjson.num2);
			}
		)
	})
*/