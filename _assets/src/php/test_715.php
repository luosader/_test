<?php
	header('Content-Type:text/html;charset=UTF-8');
	abstract class my_class{
		protected $Orz;
		abstract function fun($a);
		abstract function cla();
	}
	class test extends my_class{
		public function fun($a,$b=3){//$b必须赋值,除非你在my_class::fun()中定义了$b
			return $a*$b;
		}
		public function cla(){
			echo "eat";
		}
	}

	$var = new test;
	echo $var->fun(4);//$b有默认值
	echo "<br>";
	echo $var->fun(4,6);//对$b重新赋值
	echo "<br>";
	echo $var->cla();//前面用了echo,后面就不需要了


	abstract class my_class{
		// protected $Orz;
		abstract protected function chou1();
		abstract protected function chou2($pre);
		public function out(){
			// echo '';
			echo $this->chou1();
		}
	}
	class test extends my_class{
		protected function chou1(){//$b必须赋值,除非你在my_class::fun()中定义了$b
			return '抽象方法实例化';
		}
		public function chou2($pre){
			return $pre+$pre;
		}
	}

	$var = new test;
	$var->out();//$b有默认值,前面用了echo,后面就不需要了
	echo "<br>";
	echo $var->chou2(1);//对$b重新赋值
	echo "<br>";
	// echo $var->cla();


	abstract class my_class{
		// protected $Orz;
		abstract protected function chou1();
		abstract protected function chou2($pre);

		public function __construct(){
			echo "父类构造";
		}

		public function out(){
			// echo '';
			echo $this->chou1();
		}

		public function __destruct(){
			echo "父类析构";
			echo "<br>";
		}
	}
	class test extends my_class{
		public function __construct(){
			parent::__construct();
			echo '<br>';
			echo "子类构造";
			echo '<br>';
		}

		protected function chou1(){//$b必须赋值,除非你在my_class::fun()中定义了$b
			return '抽象方法实例化';
			echo "<br>";
		}
		public function chou2($pre){
			return $pre+$pre;
			echo "<br>";
		}

		public function __destruct(){
			parent::__destruct();//若果父类中有就必须要写,否则不显示父类
			echo "子类析构";
		}
	}

	$var = new test;//显示test中包含的构造函数以及析构函数中值






//作业715
// 1.建立一个abstract（抽象）类（EG:动物类）
// 2.在新建一个具体的某种动物的类继承抽象类（例如刚刚的动物类）
// 3.在新建的具体动物类里面实例化抽象方法，例如有的动物是走的，有的是飞的等等
// 4.实例化具体的动物类，并且调用这些方法
// 5.加成分，熟练使用构造函数和析构函数
?>

