<?php
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// error_reporting(0);
require '_lib/func.php';

// https://zhuanlan.zhihu.com/p/29478077
echo 'PHP7 的亮点：', BR;

/*统一了变量语法 - 一个笼统的判定规则是，由左向右结合。*/
// $$foo['bar']['baz']; // 实际为：($$foo)['bar']['baz']; PHP 5 中为：${$foo['bar']['baz']};

/**
 * 标量类型声明
 * 可以使用字符串(string), 整数 (int), 浮点数 (float), 以及布尔值 (bool)，来声明函数的参数类型与函数返回值。
 * 强制模式 (默认)
 * 严格模式加 declare(strict_types=1);
 */
function add(int $a, int $b): int
{
    return $a + $b;
}
echo add(1.5, 2.6), BR;

/*NULL 合并运算符*/
$c = $c ?? 'default';
dump($c);

/*太空船运算符（组合比较符）*/
$a = 2;
$b = 1;
dump($a <=> $b);

/*define() 定义常量数组*/
define('ARR', ['a', 'b']);
dump(ARR);

/*匿名类*/

/*Closure::call()*/
class A
{
    private $x = 1;
}
// PHP 7 之前版本定义闭包函数代码
$getXCB = function () {
    return $this->x;
};
// 闭包函数绑定到类 A 上
$getX = $getXCB->bindTo(new A, 'A');
echo $getX();
print(PHP_EOL);

// PHP 7+ 代码
$getX = function () {
    return $this->x;
};
dump($getX->call(new A));

/*过滤 unserialize()*/

/*IntlChar()*/
// printf('%x', IntlChar::CODEPOINT_MAX);
// echo IntlChar::charName('@');
// var_dump(IntlChar::ispunct('!'));

/*CSPRNG - 伪随机数产生器*/
$bytes = random_bytes(5);
dump(bin2hex($bytes));
dump(random_int(100, 999));
dump(random_int(-1000, 0));

/*异常 - 向下兼容及增强旧的assert()函数*/
// 将 zend.assertions 设置为 0：
ini_set('zend.assertions', 0);
assert(true == false);
echo 'Hi!', BR;
// // 将 zend.assertions 设置为 1，assert.exception 设置为 1：
// ini_set('zend.assertions', 1);
// ini_set('assert.exception', 1);
// assert(true == false);
// echo 'Hi!', BR;

/**
 * 命名空间引用优化
 * use 语句
 */
// PHP7以前语法的写法
// use FooLibrary\Bar\Baz\ClassA;
// use FooLibrary\Bar\Baz\ClassB;
// // PHP7新语法写法
// use FooLibrary\Bar\Baz\{ ClassA, ClassB};

/*错误处理*/
class MathOperations
{
    protected $n = 10;

    // 求余数运算，除数为 0，抛出异常
    public function doOperation(): string
    {
        try {
            $value = $this->n % 0;
            return $value;
        } catch (DivisionByZeroError $e) {
            return $e->getMessage();
        }
    }
}
$mathOperationsObj = new MathOperations();
dump($mathOperationsObj->doOperation());

/*intdiv() 函数 - 第一个参数除于第二个参数的值并取整*/
echo intdiv(9, 3), PHP_EOL;
echo intdiv(10, 3), PHP_EOL;
echo intdiv(5, 10), PHP_EOL;

/*Session 选项 - 可以接收一个数组作为参数，可以覆盖 php.ini 中 session 的配置项*/
session_start([
    'cache_limiter'   => 'private', //在读取完毕会话数据之后马上关闭会话存储文件
    'cookie_lifetime' => 3600, //SessionID在客户端Cookie储存的时间，默认是0，代表浏览器一关闭SessionID就作废
    'read_and_close'  => true, //在读取完会话数据之后， 立即关闭会话存储文件，不做任何修改
]);
$_SESSION['name'] = 'quan';
dump($_SESSION['name']);

/*Unicode字符格式支持*/
dump("\u{9999}");

/*匿名函数*/
// $anonymous_func = function () {return 'function';};
// echo $anonymous_func(); // 输出function

/*Throwable 接口 - 极大增强 PHP 错误处理能力*/

/*可见性修饰符的变化*/
// class YourClass 
// {
//     const THE_OLD_STYLE_CONST = 'One';
//     public const THE_PUBLIC_CONST = 'Two';
//     private const THE_PRIVATE_CONST = 'Three';
//     protected const THE_PROTECTED_CONST = 'Four';
// }

/*PHP7带来的废弃*/
// 1.废弃的特性
//     不能使用同名的构造函数：在 PHP4 中类中的函数可以与类名同名
//     实例方法不能用静态方法的方式调用：以静态的方式调用非静态方法
//     password_hash() 随机因子选项： 函数原 salt 量不再需要由开发者提供了。函数内部默认带有 salt 能力，无需开发者提供 salt 值。
//     capture_session_meta SSL 上下文选项废弃了：在流资源上活动的加密相关的元数据可以通过 stream_get_meta_data() 的返回值访问。
// 2.移除的扩展
//     Ereg 正则表达式
//     mssql 
//     mysql 
//     sybase_ct 
// 3.废弃的函数方法调用
// call_user_method(); //Fatal error: Uncaught Error: Call to undefined function call_user_method() in E:\WWW\_test\test7.0.php:30 Stack trace: #0 {main} thrown in E:\WWW\_test\test7.0.php on line 30
// ……
// 4.废弃的用法
// $HTTP_RAW_POST_DATA 变量被移除, 使用php://input来代
// ini文件里面不再支持#开头的注释, 使用”;”
// 移除了ASP格式的支持和脚本语法的支持
// 5.移除的 SAPI：服务器应用编程接口，sapi通俗的讲就是php-cgi,php-cli,mod_php等
//     aolserver apache apache_hooks apache2filter caudium continuity isapi milter nsapi phttpd pi3web roxen thttpd tux webjames

/*PHP7带来的变更*/
// 1.字符串处理机制修改
//     含有十六进制字符的字符串不再视为数字, 也不再区别对待.var_dump("0x123" == '291'); // false
// 2.整型处理机制修改
// 3.参数处理机制修改不支持重复参数命名
//     function func(a,b, c,c) {} ;会报错
// 4.foreach修改foreach()循环对数组内部指针不再起作用
// 5. ①list修改不再按照相反的顺序赋值 //$arr将会是[1,2,3]而不是之前的[3,2,1]； ②不再支持字符串拆分功能； ③不再允许赋值list() = [123]; ④list()现在也适用于数组对象；
// 6.变量处理机制修改对变量、属性和方法的间接调用现在将严格遵循从左到右的顺序来解析
