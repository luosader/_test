<?php
header('Content-Type:text/html;charset=UTF-8');
/*
function 自定义函数名(变量1,变量2,变量3,...){语法}//自定义函数结构
自定义函数名(变量值或另一个变量,...);//自定义函数调用,注意顺序
*/
	function p($arr){
		echo '<div>'.'<pre>';
		print_r($arr);
		echo '</pre>'.'</div>';
	}
	function echoArr($arr,$sp=" "){
		foreach($arr as $k=>$v){
		if($k==count($arr)-1)
			echo $v;
		else
			echo $v.$sp;
		}
	}
	$a=array('亚索','劫','艾克');
	echoArr($a,',');echo '<hr>';
	echoArr($a,'.');echo '<hr>';
	echoArr($a,'/');echo '<hr>';
	echoArr($a,'-');echo '<hr>';
	echoArr($a);echo '<hr>';
  	p($a);//把默认变量$arr换成了$a;

  	function sumAdd($m,$n){
  		$t=$m+$n;
  		return $t;
  	}
  	echo sumAdd(100,3);
  	
    function sum(){
      $t=func_get_args();
      //p($t);
      for ($i=0; $i < count($t); $i++) { 
        $m += $t[$i];
      }
      return $m;
    /*
		foreach($t as $v){
			$s+=$v;
		}
		return $s;

		$s = arrsay_sum($t);
		return $s;
    */
    }//func_get_args返回一个包含函数参数列表的数组;  count()函数计算数组中的单元数目或对象中的属性个数。


    echo sum(1,2).'<br>';
    echo sum(4,10,2).'<br>';
    echo sum(20,5,15).'<br>';

	function xo($s){return htmlspecialchars($s);}//等同于htmlspecialchars($s);
	$s="<font color=red size=6>我的意志从未改变</font>";
	echo $s.'<br>';
	echo htmlspecialchars($s).'<br>';
	echo xo($s);



$font = dirname(__FILE__).'/font/Amerika_Sans.ttf';
var_dump($font);
$f = __FILE__;
var_dump($f);




?>