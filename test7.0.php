<?php
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// error_reporting(0);
require '_lib/func.php';

$a = 2;
$b = 1;
dump($a <=> $b);

$c = $c ?? 'default';
dump($c);

// define() 定义常量数组
define('ARR', ['a', 'b']);
dump(ARR);

// 匿名函数
$anonymous_func = function () {return 'function';};
echo $anonymous_func(); // 输出function

// Unicode字符格式支持
dump("\u{9999}");

// // 命名空间引用优化// PHP7以前语法的写法
// use FooLibrary\Bar\Baz\ClassA;
// use FooLibrary\Bar\Baz\ClassB;
// // PHP7新语法写法
// use FooLibrary\Bar\Baz\{ ClassA, ClassB};

// 类型的声明
// 可以使用字符串(string), 整数 (int), 浮点数 (float), 以及布尔值 (bool)，来声明函数的参数类型与函数返回值。
// 代码：declare(strict_types=1);
function add(int $a, int $b): int
{
    return $a + $b;
}
echo add(1.5, 2.6), BR;

/*PHP7带来的废弃*/
// 1.废弃扩展
//     Ereg 正则表达式
//     mssql
//     mysql
//     sybase_ct
// 2.废弃的特性
//     不能使用同名的构造函数
//     实例方法不能用静态方法的方式调用
// 3.废弃的函数方法调用
// call_user_method(); //Fatal error: Uncaught Error: Call to undefined function call_user_method() in E:\WWW\_test\test7.0.php:30 Stack trace: #0 {main} thrown in E:\WWW\_test\test7.0.php on line 30
// ……
// 4.废弃的用法
// $HTTP_RAW_POST_DATA 变量被移除, 使用php://input来代
// ini文件里面不再支持#开头的注释, 使用”;”
// 移除了ASP格式的支持和脚本语法的支持

/*PHP7带来的变更*/
// 1.字符串处理机制修改
//     含有十六进制字符的字符串不再视为数字, 也不再区别对待.var_dump("0x123" == "291"); // false
// 2.整型处理机制修改
// 3.参数处理机制修改不支持重复参数命名
//     function func(a,b, c,c) {} ;会报错
// 4.foreach修改foreach()循环对数组内部指针不再起作用
// 5. ①list修改不再按照相反的顺序赋值 //$arr将会是[1,2,3]而不是之前的[3,2,1]； ②不再支持字符串拆分功能； ③不再允许赋值list() = [123]; ④list()现在也适用于数组对象；
// 6.变量处理机制修改对变量、属性和方法的间接调用现在将严格遵循从左到右的顺序来解析
