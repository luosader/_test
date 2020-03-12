<?php
header('Content-Type:text/html;charset=UTF-8');

    /**
    * 注册时用户名,邮箱重复验证;
    * 登录时检测是否有该用户。
    */
    //用户名重复验证
    Public function regcheckuser(){
        $Service=M('t_user');
        $data['user_name']=$_POST["param"];
        $reusername=$Service->where($data)->select();

        if(empty($reusername)) {
            echo '{
            "info":"",
            "status":"y"
            }'; 
        }
        else{
            echo '{
            "info":"用户名已存在，请更换个试试",
            "status":"n"
            }'; 
        }
    }

    //邮箱重复验证
    Public function checkemail(){
        $Service=M('t_user');
        $data['user_email']=$_POST["param"];
        $reuseremail=$Service->where($data)->select();

        if(empty($reuseremail)) {
            echo '{
            "info":"",
            "status":"y"
            }'; 
        }else{      
            echo '{
            "info":"该邮箱已注册，请更换其他邮箱！",
            "status":"n"
            }'; 
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form_Validform验证</title>
</head>
<body>
    <form id="registerform" action="php/index.php?rec=register" method="post" role="form">
        <dl class="regList">
        	<!-- <dt>邀请码：</dt>
            <dd><input type="text" name="useryao" class="regIn fl" style="width:242px;" datatype="*" sucmsg="邀请码正确" nullmsg="请填写邀请码！" /></dd> -->

        	<dt>用户名：</dt>
            <dd><input type="text" name="user_name" class="regIn fl " style="width:242px;" placeholder="用户名" datatype="*5-16"  ajaxurl="__ROOT__/index.php?m=Public&a=regcheckuser" sucmsg="用户名还未被使用，可以注册！" nullmsg="请填写用户名！" errormsg="昵称至少5个字符,最多16个字符！" /></dd>

        	<dt>密码：</dt>
            <dd><input type="password" name="pwd" class="regIn fl" style="width:242px;" placeholder="密码" datatype="*6-15" sucmsg="密码格式正确！" nullmsg="请填写密码！" errormsg="密码范围在6~15位之间！" /></dd>
        	<dt>重复密码：</dt>
            <dd><input type="password" name="pwdok" class="regIn fl" style="width:242px;" placeholder="重复密码" datatype="*" recheck="pwd" sucmsg="正确！" nullmsg="请再次填写密码！" errormsg="您两次输入的账号密码不一致！" /></dd>
        	<dt>电子邮件：</dt>
            <dd><input type="text" name="user_email" class="regIn fl" style="width:242px;" placeholder="邮箱" datatype="e" ajaxurl="__ROOT__/index.php?m=Public&a=checkemail" sucmsg="邮箱正确！" nullmsg="请填写邮箱！" errormsg="邮箱格式不对！" /></dd>
        	<!-- <dt>验证码：</dt>
            <dd><input type="text" name="verify" class="regIn fl" style="width:150px;" datatype="s" ajaxurl="__ROOT__/index.php?m=Public&a=checkverify" sucmsg="验证码正确！" nullmsg="请填写验证码！" /><a style="padding:15px" href=""><img src="__APP__?m=Public&a=verify"></a></dd> -->
            <dt>&nbsp;</dt>
            <dd><input type="radio" name="" value="1" datatype="radio" errormsg="请选中条文！"> 我已阅读并接受 <a class="blue" href="#"><strong>版权声明</strong></a> 和 <a class="blue" href="#"><strong>隐私保护</strong></a> 条文</dd>
            <dt style=" height:150px;">&nbsp;</dt>
            <dd style="height:150px;"><button class="btnBlue" type="submit">立刻注册</button></dd>
        </dl>
    </form>

<script src="jquery-1.11.1.js"></script>
<script src="Validform_v5.3.2_min.js"></script> 
<script type="text/javascript">
    $(function(){
        $("#registerform").Validform({
            tiptype:4
        });
    })
</script>
</body>
</html>