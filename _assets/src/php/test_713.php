<?php
//作业713 写一个有意义的类，参照以下模板
//使用随机数组 起名字
//网游注册时的随机起名字
// //  class：定义类
// // 	public：公开
// // 	protected：保护
// // 	private：私有
// // 	function：方法
// // 	new：实例化一个对象
// // 	$this：在对象内部，指代本对象自己
// <?php
// 	header('Content-Type:text/html;charset=UTF-8');

// 	class {
// 		//属性

// 		//方法
// 		//构造方法
// 		public function __construct(){

// 		}
//         //业务逻辑
        
// 		//析构函数
// 		public function __destruct(){
			
// 		}
// 	}

header('Content-Type:text/html;charset=UTF-8');
//定义类
	class char{
		// 属性
		public $a = 1;//给公开的变量$a一个初始值1
		var $b = 1;
		protected $c;
		private $d;
		var $e = 3;
		
		// 构造方法function
		public function f1(){
			// echo $this->b = 2;
			return $this->b;
		}
		protected function f2(){
			return $this->f1();
		}
		private function f3(){
			return $this->f2();
		}
		public function f4(){
			// return $this -> b + $e;
			// return $this->e+$this->f3(); 
			return $this->e+char::f3(); 
		}
	}
	//实例化
	$pdd = new char();//初始化char类
	echo $pdd->f4();//重新赋值并打印

echo '<br />';


//不同方法，同一个效果
class test1{ 
	var $b;
	function test1() { $this->b=5; }//知识点：在PHP4中也提供了构造函数，但使用的是与类同名的类方法，在PHP5仍能兼容这种做法，当一个类中没有包含__construct时，会查找与类同名的方法，如果找到，就认为是构造函数
	function addab($c) { return $this->b+$c; }
}
$a = new test1(); echo $a->addab(4); // 返回 9

echo '<br />';

class test2{ 
	var $b;
	function change() { return $this->b=5; }
	function addab($c) { return $this->change()+$c; }
}
$a = new test2; echo $a->addab(4); // 返回 9

echo '<br />';
//
class demo{
	var $d = '洛萨';
	function name(){
		echo $this->d;
	}
	function wel(){
		echo '欢迎';
		$this->name();
	}

}
$print = new demo();
$print -> d = '洛萨维客';
$print -> wel();

echo '<br />';

class classes{
	private $teacher;//老师
	private $student;//学生
	private $classname;//班级名
	private $subject;//学科

	//方法
	//构造函数
	public function __construct($teacher,$student,$classname,$subject){
		$this->teacher = $teacher;
		$this->student = $student;
		$this->classname = $classname;
		$this->subject = $subject;
	}

	public function getAll(){
		$a = array();
		$a['teacher'] = $this->teacher;
		$a['student'] = $this->student;
		$a['classname'] = $this->classname;
		$a['subject'] = $this->subject;
		return $a;
	}
	//获得老师名
	public function getTea(){
		return $this->teacher;
	}
	//设置老师名
	public function setTea($teacher){
		$this->teacher = $teacher;
	}
	//获得学生名
	public function getStu(){
		return $this->student;
	}
	//设置学生名
	public function setStu($student){
		$this->student = $student;
	}
	//获得班级名
	public function getCla(){
		return $this->classname;
	}
	//设置班级名
	public function setCla($classname){
		$this->classname = $classname;
	}
	//获得学科名
	public function getSub(){
		return $this->subject;
	}
	//设置学科名
	public function setSub($subject){
		$this->subject = $subject;
	}
		
	//析构函数
	public function __destruct(){

	}
}

$classes = new classes('张老师','余敏','302班','语文');
$classes->setSub('数学');
foreach ($classes->getAll() as $key => $value) {
	echo $key = $value;
}
	echo '<br />';
var_dump($classes->getAll());
echo $classes->getTea();
echo '<br />';
echo $classes->getSub();

echo '<br />';




?>
