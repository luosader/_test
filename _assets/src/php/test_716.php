<?php
	header('Content-Type:text/html;charset=UTF-8');
	//声明一个接口(定义)
	interface jie{
		//必须每个方法都没有方法体，并且为public
		public function j1();
		public function j2();
	}
	//实现一个接口
	class jc implements jie{
		//实现接口，即需要有方法体{}
		public function j1(){
			return 123;
		}
		public function j2(){
			// return '\n键盘';//\n不实现
			return "\n键盘<br>";
		}
	}
	$p = new jc;
	echo $p -> j1();
	echo $p -> j2();


//具有业务意义的接口例子

	//电脑接口定义
	//电脑的USB接口设计规范
	interface USB{
		const WIDTH=12;
		const HEIGHT=3;
		function load();//接口设备加载方法
		function run();//接口设备运行方法
		function stop();//接口设备停止方法
	}

	//实现接口的具体类
	//USB设备鼠标的设计规范
	class Mouse implements USB{
		function load(){
			echo "加载鼠标成功！<br>";
		}
		function run(){
			echo "运行鼠标成功！<br>";
		}
		function stop(){
			echo "鼠标停止运行！<br>";
		}
		function showWIDTH(){
			echo self::WIDTH."<br>";
		}
		function showHEIGHT(){
			echo self::HEIGHT."<br>";
		}
	}

	//实现接口的具体类
	//USB设备键盘的设计规范
	class Keypress implements USB{
		function load(){
			echo "加载键盘成功！<br>";
		}
		function run(){
			echo "运行键盘成功！<br>";
		}
		function stop(){
			echo "键盘停止运行！<br>";
		}
		function showWIDTH(){
			echo self::WIDTH."<br>";
		}
		function showHEIGHT(){
			echo self::HEIGHT."<br>";
		}
	}

	//电脑类
	//如何使用USB设备
	//因为都有USB设备都有相同接口，所以使用方式相同
	class Computer{
		function userUSB(USB $usb){//这里是一种多态
			$usb->load();
			$usb->run();
			$usb->stop();
			$usb->showWIDTH();
			$usb->showHEIGHT();

		}
	}

	$k = new Computer();

	$i=new Mouse;
	$j=new Keypress;

	$k->userUSB($i);
	$k->userUSB($j);


	 //门功能实现
	//门
	class door{
		public function open(){
			echo "<br>";
			echo "门开了<br>\n";
		}

		public function close(){
			echo "门关了<br>";
		}
	}

	//报警接口。因为报警不是门类的能力
	interface alarm{
		public function alarm();
	}

	//带有报警功能的门
	class door2 extends door implements alarm{
		public function alarm(){
			echo "叮铃铃...<br>";
		}
	}

	$door2 = new door2;
	$door2->open();
	// $door2->close();
	$door2->alarm();


//魔术方法
		class a{
			public $x=1;
			//调用不存在属性时
			public function __get($cname){
				echo "不存在！";
				echo "__get 参数名：".$cname."<br>\n";
			}

			//给不存在属性赋值时
			public function __set($cname,$cvalue){
				echo "__set 参数名：".$cname."<br>\n";
				echo "__set 参数值：".$cvalue."<br>\n";
			}

			//调用不存在方法时
			public function __call($mname,$mvalue){
				echo "__call 方法名称：".$mname."<br>\n";
				echo "__call 方法参数：<br>\n".print_r($mvalue,true);
				echo "<br>\n";
			}

			//对象复制时
			public function __clone(){
				echo "正在复制<br>\n";
			}

			//对象字符串化时
			public function __toString(){
				return "当作字符串使用";
			}

			//类型约束，使用类名
			public function y(z $z){}

			//类型约束，使用数组
			public function yy(array $zz){}

		}

		$a=new a;
		//调用不存在属性
		echo "<br>\n";
		$a->a1;
		//给不存在属性赋值
		echo "<br>\n";
		$a->a1=5;
		//调用不存在方法
		echo "<br>\n";
		$a->b1();
		$a->b2(111);
		$a->b3(1,3);
		//对象引用
		echo "<br>\n";
		$b=$a;
		//对象复制
		echo "<br>\n";
		$c=clone $a;
		$a->x=2;
		echo $a->x;
		echo "<br>\n";
		echo $b->x;//$b和$a,在内存中是一个引用位置,如果$a发生变化,$b也会发生
		echo "<br>\n";
		echo $c->x;//$c和$a，在内存中是两块空间，互不影响
		echo "<br>\n";
		//对象字符串化
		echo $a;
		echo "<br>\n";

		//对象比较
		if ($b==$a) {//如果两个对象的属性和属性值相等，且两个对象是同一个类的实例
			echo "b和a相等<br>\n";
		} else {
			echo "b和a不相等<br>\n";
		}
		if ($b===$a) {//属性和属性值都相等，且两个对象变量一定指向某个类的同一个实例(即一个对象)
			echo "b和a完全相等<br>\n";
		} else {
			echo "b和a不完全相等<br>\n";
		}

?>