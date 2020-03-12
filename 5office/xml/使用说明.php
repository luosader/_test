<?php
http://www.jb51.net/article/51127.htm

// php的SimpleXML方法读写XML接口文件实例解析
在php5中读写xml文档是非常方便的，可以直接使用php的SimpleXML方法来快速解析与生成xml格式的文件，下面举例说明：
创建一个SimpleXML对象有三种方法：
1.使用new关键字创建
$xml="<personinfo><item><id>1</id><name>aaa</name><age>16</age></item>
<item><id>2</id><name>bbb</name><age>26</age></item></personinfo>";
$rss=new SimpleXMLElement($xml);



2.使用simplexml_load_string()创建
$xml="<personinfo><item><id>1</id><name>aaa</name><age>16</age></item>
<item><id>2</id><name>bbb</name><age>26</age></item></personinfo>";
$rss=simplexml_load_string($xml);

3.使用simplexml_load_file()从一个URL创建
$rss=simplexml_load_file("rss.xml");
//或者：
$rss=simplexml_load_file("/rss.xml");//远程文档

具体实例如下：
$xml="<personinfo><item><id>1</id><name>aaa</name><age>16</age></item><item><id>2</id><name>bbb</name><age>26</age></item></personinfo>";
$rss=new SimpleXMLElement($xml);
foreach($rss->item as $v){
 echo $v->name,'<br />';
}
echo $rss->item[1]->age;//读取数据
echo '<hr>';
$rss->item[1]->name='ccc';//修改数据
foreach($rss->item as $v){
 echo $v->name,' <br /> ';//aaa <br /> ccc <br />
}
echo '<hr>';
unset($rss->item[1]);//输出数据
foreach($rss->item as $k=>$v){
 echo $v->name,' <br /> ';//aaa <br />
}
echo '<hr>';
//添加数据
$item=$rss->addChild('item');
$item->addChild('id','3');
$item->addChild('name','ccc_new');
$item->addChild('age','40');
foreach($rss->item as $k=>$v){
 echo $v->name,' <br /> ';//aaa <br /> ccc_new <br />
}
$rss->asXML('personinfo.xml');


进一步分析上面例子如下：
//xml数据的读取
//可以直接通过元素的名称来访问特定的元素。文档中的所有元素都被看成是该对象的属性。
foreach($rss->item as $v){
    echo $v->name,' <br /> ';//aaa <br /> bbb <br />
}
echo $rss->item[1]->age;//26
//xml数据修改，可以直接利用对象属性赋值的方法来直接编辑一个元素的内容
$rss->item[1]->name='ccc';//修改数据
foreach($rss->item as $v){
    echo $v->name,' <br /> ';//aaa <br /> ccc <br />
}
//可以用php内容函数unset来将一个元素从树中删除
unset($rss->item[1]);
foreach($rss->item as $v){
    echo $v->name,' <br /> ';//a www.jb51.net aa <br />
}
//xml添加元素数据，可通过对象的addChild方法来实现
$item=$rss->addChild('item');
$item->addChild('id','3');
$item->addChild('name','ccc_new');
$item->addChild('age','40');
foreach($rss->item as $k=>$v){
    echo $v->name,' <br /> ';//aaa <br /> ccc_new <br />
}
//xml数据的存储
//使用对象的asXML()方法
$rss->asXML('personinfo.xml');//将xml数据存储到personinfo.xml文件中