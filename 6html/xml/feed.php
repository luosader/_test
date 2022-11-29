<?php 

/**
* 
*/
class feed{
	public $title = ''; // channel的title
	public $link = ''; // channel的link
	public $description = ''; // channel的description
	public $template = '';  // xml的模板

	protected $dom = NULL;
	public function __construct(){
		$this->dom = new DOMDocument('1.0','utf-8');
		$this->dom->load('./feed.xml');
	}

	// 封装一个方法，直接实现创建<name>value</name>的节点
	protected function createEle($name,$value){
		$ele = $this->dom->createElement($name);
		$text = $this->dom->createTextNode($value);
		$ele->appendChild($text);
		return $ele;
	}

	// 封装一个方法，创建item节点
	protected function createItem($arr){
		$item = $this->dom->createElement('item');
		foreach ($arr as $key => $value) {
			$node = $this->createEle($key,$value);
			$item->appendChild($node);
		}
		return $item;
	}

	// 创建channel节点
	protected function createChannel(){
		$channel = $this->dom->createElement('channel');
		$channel->appendChild($this->createEle('title',$this->title));
		$channel->appendChild($this->createEle('linl',$this->link));
		$channel->appendChild($this->createEle('description',$this->description));

	}

	// 输出
	public function display(){
		$this->createChannel();
		header('content-type:text/xml');
		echo $this->dom->saveXML();
	}
}

$feed = new feed();
$feed->display();

 ?>