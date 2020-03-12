<?php
	header('Content-Type:text/html;charset=UTF-8');
	error_reporting(6143);//错误验证级别：最大  error_reporting(E_ALL);
	ini_set("display_error", "on");//在php.ini里设置：display_errors = on
	//error_reporting(“E_ALL”)和ini_set(“display_errors”, “on”)的区别?后者的权限大于前者，后者是OFF的话，前者就算是E-ALL也没用。
	
	// interface work{
	// 	public function work();
	// }

	// class worker {
	// 	protected $name;//姓名
	// 	protected $event;//事件

	// 	public function __construct($name,$event){
	// 		$this->name=$name;
	// 		$this->event=$event;
	// 	}

	// 	public function work(){
	// 		echo $this->name." 正在 ".$this->event;
	// 		echo "<br>";
	// 	}
	// }

	// $a=new worker('猪猪侠','拖地');
	// $b=new worker('煎饼侠','擦窗');
	// $c=new worker('大圣','打水');

	// //领导不管你是谁，能干什么，只调用你的干活接口
	// $a->work();
	// $b->work();
	// $c->work();
	$a = 3; 
	$x = &$a; 
	$b = $a++; 
	$c = ++$a;
	echo "$x".'<br>';
	echo "$b".'<br>';
	echo "$c".'<br>';
	echo '$c';



?>
