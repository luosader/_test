<?php
header('Content-Type:text/html;charset=UTF-8');
第一种：利用Page类和limit方法
$User = M('User'); // 实例化User对象
import('ORG.Util.Page');// 导入分页类
$count      = $User->where('status=1')->count();// 查询满足要求的总记录数
$Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
$show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
$list = $User->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
$this->assign('list',$list);// 赋值数据集
$this->assign('page',$show);// 赋值分页输出
$this->display(); // 输出模板
第二种：分页类和page方法的实现
$User = M('User'); // 实例化User对象
// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
$list = $User->where('status=1')->order('create_time')->page($_GET['p'].',25')->select();
$this->assign('list',$list);// 赋值数据集
import(“ORG.Util.Page”);// 导入分页类
$count      = $User->where('status=1')->count();// 查询满足要求的总记录数
$Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
$show       = $Page->show();// 分页显示输出
$this->assign('page',$show);// 赋值分页输出
$this->display(); // 输出模板
带入查询条件
如果是POST方式查询，如何确保分页之后能够保持原先的查询条件呢，我们可以给分页类传入参数，方法是给分页类的parameter属性赋值：
import('ORG.Util.Page');// 导入分页类
$mapcount      = $User->where($map)->count();// 查询满足要求的总记录数
$Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
//分页跳转的时候保证查询条件
foreach($map as $key=>$val) {
    $Page->parameter   .=   "$key=".urlencode($val).'&';
}
$show       = $Page->show();// 分页显示输出
分页样式定制
默认的分页输出效果是

我们可以对输出的分页样式进行定制，分页类Page提供了一个setConfig方法来修改默认的一些设置。例如：
$page->setConfig('header','个会员');
setConfig方法支持的属性包括：
header：头部描述信息，默认值 “条记录”
prev：上一页描述信息，默认值是“上一页”
next：下一页描述信息，默认值是“下一页”
first：第一页描述信息，默认值是“第一页”
last：最后一页描述信息，默认值是“最后一页”
theme ：分页主题描述信息，包括了上面所有元素的组合 ，设置该属性可以改变分页的各个单元的显示位置，默认值是
"%totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first% %prePage% %linkPage% %nextPage% %end%"
通过setConfig设置以上属性可以完美的定制出你的分页显示风格。
?>
<!DOCTYPE html>
<html>
<head>
	<title>数据分页</title>
</head>
<body>

</body>
</html>