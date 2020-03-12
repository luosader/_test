<?php 

/**
 * 声明一个微信平台操作类
 */

class WeCh {
	private $_appid;
	private $_appsecret;
	private $_token;//公众平台请求开发者时需要的标记
	//表示二维码的类型
	const QRCODE_TYPE_TEMP=1;
	const QRCODE_TYPE_LIMIT=2;
	const QRCODE_TYPE_LIMIT_STR=3;

	//赋值
	public function __construct($id,$secret,$token){
		$this ->_appid = $id;
		$this ->_appsecret = $secret;
		$this ->_token = $token;
	}

	private $_msg_template = array(
		'text' => '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>',
		'image' => '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[%s]]></MediaId></Image></xml>',
		'music' =>'<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[music]]></MsgType><Music><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><MusicUrl><![CDATA[%s]]></MusicUrl><HQMusicUrl><![CDATA[%s]]></HQMusicUrl></Music></xml>',
		'news' =>'<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>1</ArticleCount><Articles><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item></Articles></xml>'
    );

	//处理微信公众平台的消息
	public function responseMSG(){
		//获取请求时post的XML字符串
		//$_POST,不是key/value型,因此不能使用该数组
		$xml_str = $GLOBALS['HTTP_RAW_POST_DATA'];//xml字符串

		//如果没有post数据,停止脚本
		if(empty($xml_str)){
			die("");
		}
		//解析该xml字符串,利用simpleXML
		libxml_disable_entity_loader(true);//禁止xml实体解析,防止xml注入
		//从字串获取simplexml对象
		$request_xml = simplexml_load_string($xml_str, 'SimpleXMLElement', LIBXML_NOCDATA);;
		//判断该消息的类型通过MsgType
		switch ($request_xml->MsgType) {
			case 'event':
				//判断具体的时间类型(关注,取消关注,点击)
				$event = $request_xml->Event;
				if ($event=='subscribe') {//订阅事件
					$this->_douSubScribe($request_xml);	
				}elseif($event=='CLICK'){//菜单点击事件
					
				}
				break;
			case 'text'://文本消息
				$this ->_doText($request_xml);
				break;
			case 'image'://图片消息
				$this ->_doImage($request_xml);
				break;
			case 'vioce'://语音消息
				$this ->_doVioce($request_xml);
				break;
			case 'video'://视频消息
				$this ->_doVideo($request_xml);
				break;
			case 'shortvideo'://短视频消息
				$this ->_doShortVideo($request_xml);
				break;
			case 'location'://位置消息
				$this ->_doLocation($request_xml);
				break;	
			case 'link'://链接消息
				$this ->_doLink($request_xml);
				break;		
		}
	}

	/**
	 * 用于处理关注事件的方法
	 * $request_xml 事件信息对象
	 */
	private function _douSubScribe($request_xml){
		//利用消息发送,完成关注用户打招呼功能
		$content = "您已经成功关注王远的微信公众测试号!\n输入1or2or3,或者是'号码',可以查看到常用服务号码\n输入'新闻',还可以查看最新的新闻\n如果感觉无聊的话,还可以和小机器人聊天哦!";
		$this->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$content);
	}

	/**
	 * 回复普通消息
	 */

	private function _doText($request_xml){
		//获取文本内容
		$content = trim($request_xml->Content);
		//对内容进行判断
		if($content == '号码'){
			//显示帮助信息
            $response_content = "【1】特种服务号码\n【2】通讯服务号码\n【3】银行服务号码\n您可以通过输入【】里面的编号来获取想要的内容哦！";
			$this->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$response_content);			
		}elseif($content=='1'){
			$response_content = "常用特种服务号码：\n火警：119\n匪警：110\n急救：120";
			$this->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$response_content);
		}elseif($content == '2'){
			$response_content = "常用通讯服务号码：\n中国移动：10086\n中国电信：10000\n中国联通：我也不知道，报警自己问！";
			$this->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$response_content);		
		}elseif($content == '3'){
			$response_content = "常用银行服务号码：\n中国建设：95533\n中国工商：95588";
			$this->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$response_content);		
		}elseif($content == '音乐'){
			$title = '随便';
			$desc = '我最爱的音乐！';
			$url = 'http://1.weixin10425.applinzi.com/music.mp3';
			$hqurl = 'http://1.weixin10425.applinzi.com/music.mp3';
			$this->_msgMusic($request_xml->FromUserName,$request_xml->ToUserName,$title,$desc,$url,$hqurl);
		}elseif($content == '给个网站'){
		 	$response_content = "你找死啊?给你一个网站"."\n"."http://www.4399.com";
		 	$this->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$response_content);
		 }elseif ($content == '新闻') {
		 	$title = 'DNF又出新活动啦！';
		 	$desc = '男女弹药、男女大枪、男女漫游、男女机械、冰结师、女散打职业改版来袭。';
		 	$picurl = 'http://1.weixin10425.applinzi.com/yasina.jpg';
		 	$url = 'http://bbs.17173.com/thread-9963007-1-1.html?from=2015sytm';
		 	$this->_msgNews($request_xml->FromUserName,$request_xml->ToUserName,$title,$desc,$picurl,$url);
		 }else {
			//通过图灵机器人,响应给微信用户
			$key = 'e5f9b61b6ea642b1ae43468e44dc843a';
			$url = "http://www.tuling123.com/openapi/api?key=$key&info=$content";
			$result =$this->_requestGet($url,false);
			$result_obj = json_decode($result);
			$response_content = $result_obj->text;
			$this->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$response_content);
		 }
	}

	/**
	 * 处理图片消息
	 */
	private function _doImage($request_xml){
		$content = '您发送的是图片消息,上传的图片的mediaid:' . $request_xml->MediaId;
		$this->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$content);
	}

	/**
	 * 处理地理位置信息
	 */
	private function _doLocation($request_xml){
		//$content = '经度:' . $request_xml->Location_Y."\n".'纬度:' . $request_xml->Location_X. "\n" .'你所在的位置:' . $request_xml->Label."\n".'地图缩放大小为:' .$request_xml->Scale;
		//$this ->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$content);
		
		//利用位置获取信息
		//百度LBS圆形范围查询:返回json信息
		$url = 'http://api.map.baidu.com/place/v2/search?query=%s&location=%s&radius=%s&output=%s&ak=%s';
		$query = '银行';//查询的东西
		$location = $request_xml->Location_X .',' .$request_xml->Location_Y;//经纬度
		$radius = 2000;//查询的范围
		$output = 'json';//返回的数据形式
		$ak = 'yv9pxdsEO7V8E7B2r2UBAHCpHnDAZiQI';//秘钥
		$url = sprintf($url,urlencode($query),$location,$radius,$output,$ak);
		$result = $this->_requestGet($url,false);//json数据

		$result_obj = json_decode($result);//解码
		$re_list = array();//定义数组
		foreach ($result_obj->results as $v) {//遍历$result_obj
			$r['name'] = $v ->name;
			$r['address'] = $v ->address;
			$re_list[] = implode('-', $r);
		}
		$content ="您当前所在位置附近的银行服务："."\n" .implode("\n",$re_list);//
		$this ->_msgText($request_xml->FromUserName,$request_xml->ToUserName,$content);
	}

	/**
	 * 新增上传临时素材的方法
	 */
	public function uploadTmp($file,$type){
		//获取url
		$url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->getAccessToken().'&type='.$type;
		$data['media'] = '@'.$file;//post数据前加@,就变成文件地址
		$result = $this->_requestPost($url,$data);//返回json数据
		$result_obj = json_decode($result);
		return $result_obj;
	}


	/**
	 * 用户返回用户输入的信息
	 */
	private function _msgText($to,$from,$content){
		$response = sprintf($this->_msg_template['text'],$to,$from,time(),$content);
		die($response);
	}

	/**
	 * 返回新闻推送消息
	 */
	private function _msgNews($to,$from,$title,$desc,$picurl,$url){
		$response = sprintf($this->_msg_template['news'],$to,$from,time(),$title,$desc,$picurl,$url);
		die($response);
	}

	/**
	 * 返回用户输入的音乐信息
	 */
	private function _msgMusic($to,$from,$title,$desc,$url,$hqurl){
		$response = sprintf($this->_msg_template['music'],$to,$from,time(),$title,$desc,$url,$hqurl);
		die($response);
	}


	/**
	 * 发送图片信息
	 */

	private function _msgImage($to,$from,$type,$is_id=false){
		if($is_id){
			$media_id = $file;
		}else{
			//上传图片到微信公众服务器,获取mediaID
			$result_obj = $this->uploadTmp($file,'image');	
			$media_id = $result_obj->media_id;		
		}
		//拼凑图片类消息的xml
		$response = sprintf($this->_msg_template['image'],$to,$from,time(),$media_id);
		die($response);
	}

	/**
	 * 设置菜单
	 */

	public function menuSet($menu){
		//请求的url
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->getAccessToken();
		$data = $menu;
		$result = $this->_requestPost($url,$data);
		$result_obj = json_decode($result);
		if($result_obj->errcode == 0){
			return true;
		}else{
			return $result_obj->errmsg."</br>";
		}
	}



	/**
	 * 用于第一次验证URL合法性
	 */
	public function firstValid(){
		//验证签名的合法性
		if($this ->_checkSignature()){
			//签名合法,告知给微信公众平台服务器
			echo $_GET['echostr'];
		}
	}

	/**
	 * 验证签名
	 * @param bool 
	 */
	private function _checkSignature(){
		$signature = $_GET['signature'];
		$timestamp = $_GET['timestamp'];
		$nonce = $_GET['nonce'];
		//将时间戳,随机字符串,token按照字母顺序排序并连接
		$tmp_arr = array($this->_token,$timestamp,$nonce);
		sort($tmp_arr,SORT_STRING);//按字母排序,字典顺序
		$tmp_str = implode($tmp_arr);//连接
		$tmp_str = sha1($tmp_str);//sha1加密
		//进行对比
		if($signature==$tmp_str){
			return true;
		}else{
			return false;
		}

	}

	/**
	 * 获取access_token
	 * @param string $token_file 用来存储access_token的临时文件
	 */
	public function getAccessToken(){
		//考虑access_token是否过期问题,把获取的存储在文件内
		// $life_time = 7200;
		// if(file_exists($token_file) && time()-filemtime($token_file)<$life_time){
		// 	//access_token存在并且有效
		// 	return file_get_contents($token_file);//把获取到的access_token文件返回
		// }
		//若上述不成立,则执行获取新的access_token操作
		//目标URL
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this ->_appid}&secret={$this ->_appsecret}";
		//向该目标URL发送GET请求
		//封装一个_requestGet请求方法,方便使用
		$result = $this->_requestGet($url);
		if(!$result){
			return false;
		}
		//存在返回响应结果
		//对返回的json结果进行解码
		$result_obj = json_decode($result);//返回对象格式,//如果添加第二个参数true,返回的就是数组格式
		//获取到access_token,写入$token_file
		//file_put_contents($token_file,$result_obj->access_token);
		return $result_obj->access_token;//因为返回的是对象类型,所以对象调用成员
	}
	//获取ticket
	private function getQRCodeTicket($content,$type=1,$expire=604800){
		$access_token = $this ->getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";
		$type_list = array(
			self::QRCODE_TYPE_TEMP =>'QR_SCENE',
			self::QRCODE_TYPE_LIMIT =>'QR_LIMIT_SCENE',
			self::QRCODE_TYPE_LIMIT_STR =>'QR_LIMIT_STR_SCENE',
			);
		$action_name = $type_list[$type];
		switch ($type) {
			case 1:
				$data_arr['expire_seconds'] = $expire;
				$data_arr['action_name'] = $action_name;
				$data_arr['action_info']['scene']['scene_id'] = $content;
				break;
			case 2:
			case 3:
				$data_arr['action_name'] = $action_name;
				$data_arr['action_info']['scene']['scene_id'] = $content;
				break;
		}
		$data = json_encode($data_arr);
		$result = $this->_requestPost($url,$data);
		if(!$result){
			return false;
		}
		//处理响应数据
		$result_obj = json_decode($result);
		return $result_obj ->ticket;//返回ticket
	}
	//获取二维码
	public function getQRCode($content,$file=NULL,$type=1,$expire=604800){
		//获取ticket
		$ticket = $this ->getQRCodeTicket($content,$type=1,$expire=604800);
		//发送GET请求
		$url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
		$result = $this ->_requestGet($url);//若正确,则此时的result就是二维码图像
		if($file){
			file_put_contents($file,$result);
		}else{
			ob_start();
			header('Content-Type:image/jpeg');
			echo $result;			
		}
	}

	public function _requestPost($url,$data=array(),$ssl=true){
		//开启curl拓展
		//curl发送请求
		$curl = curl_init();//初始化资源

		curl_setopt($curl,CURLOPT_URL,$url);//请求URL
		
		//请求代理信息,有就使用$_SERVER,没有就默认一个
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0';
		curl_setopt($curl,CURLOPT_USERAGENT,$user_agent);//user_agent请求代理信息
		
		//referer头,请求来源
		curl_setopt($curl,CURLOPT_AUTOREFERER,true);
		//设置超时时间
		curl_setopt($curl,CURLOPT_TIMEOUT,10);

		//SSL相关
		if($ssl){
			//禁止后curl将终止从服务器端进行验证,因为相信目标服务器,所以不进行验证
			curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);

			//设置成 2，会检查公用名是否存在，并且是否与提供的主机名匹配。 在生产环境中，这个值应该是 2（默认值）。 
			curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
		}
		//处理post相关任务
		curl_setopt($curl,CURLOPT_POST,true);//是否为post请求
		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);//处理请求信息
		//处理响应结果
		curl_setopt($curl,CURLOPT_HEADER,false);//是否处理响应头,选择不处理
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);//是否返回响应结果

		//发出请求
		$response = curl_exec($curl);
		//判断请求情况
		if($response===false){
			//echo curl_error($curl);
			return false;
		}
		//请求成功
		return $response;		
	}

	//封装的GET方法
	/**
	 * 发送GET请求
	 * @param string $url URL
	 * @param bool $ssl 是否为https协议
	 * @return  string 响应主体content
	 */
	private function _requestGet($url,$ssl=true){
		//开启curl拓展
		//curl发送请求
		$curl = curl_init();//初始化资源

		curl_setopt($curl,CURLOPT_URL,$url);//请求URL
		
		//请求代理信息,有就使用$_SERVER,没有就默认一个
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0';
		curl_setopt($curl,CURLOPT_USERAGENT,$user_agent);//user_agent请求代理信息
		
		//referer头,请求来源
		curl_setopt($curl,CURLOPT_AUTOREFERER,true);

		//SSL相关
		if($ssl){
			//禁止后curl将终止从服务器端进行验证,因为相信目标服务器,所以不进行验证
			curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);

			//设置成 2，会检查公用名是否存在，并且是否与提供的主机名匹配。 在生产环境中，这个值应该是 2（默认值）。 
			curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
		}
		curl_setopt($curl,CURLOPT_HEADER,false);//是否处理响应头,选择不处理

		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);//是否返回响应结果

		//发出请求
		$response = curl_exec($curl);
		//判断请求情况
		if(false===$response){
			//echo curl_error($curl);
			return false;
		}
		//请求成功
		return $response;
	}
}

 ?>