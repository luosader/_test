<?php 

/**
 * 声明一个微信操作类
 */
 
 class Wechat{
 	//
 	private $_appid;
 	private $_appsecret;

 	//action_name 常量
 	const QRCODE_TYPE_TEMP = 1;//临时
 	const QRCODE_TYPE_LIMIT = 2;//永久整型
 	const QRCODE_TYPE_LIMIT_STR = 3;//永久字符串

 	//赋值
 	public function __construct($id,$secret){
 		$this ->_appid = $id;
 		$this ->_appsecret = $secret;
 	}

 	//获取access_token
 	private function getAccessToken(){
 		//获取url
 		// $life_time = 7200;
 		// if(file_exists($token_file) && time()-filemtime($token_file)<$life_time){
 		// 	return file_get_contents($token_file);
 		// }
 		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->_appid}&secret={$this->_appsecret}";
 		$result = $this->_requestGet($url);//返回一个json数据
 		if(!$result){
 			return false;
 		}
 		$result_obj = json_decode($result);//解码
 		//file_put_contents($token_file,$result_obj->access_token);
 		return $result_obj ->access_token;//返回access_token
 		}

 		//获取ticket
 		private function getQRCodeTicket($content,$type=1,$expire=604800){
 			//获取access_token
 			$access_token = $this ->getAccessToken();
 			//获取url
 			$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";

 			//下面的信息中,action_name 和scene_id的值会随着用户输入而改变,所以需要单独判定
 			//而且当二维码是临时的话,必须设置过期时间,则有$expire
 			//{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
 			//拼凑一条$data出来
 			$type_list = array(
 				self::QRCODE_TYPE_TEMP =>'QR_SCENE',
 				self::QRCODE_TYPE_LIMIT =>'QR_LIMIT_SCENE',
 				self::QRCODE_TYPE_LIMIT_STR =>'QR_LIMIT_STR_SCENE'
 			);
 			$action_name = $type_list[$type];//action_name
 			switch ($type) {
 				case self::QRCODE_TYPE_TEMP:
 					$data_arr['expire_seconds'] = $expire;
 					$data_arr['action_name'] = $action_name;
 					$data_arr['action_info']['scene']['scene_id'] = $content;
 					break;
 				case self::QRCODE_TYPE_LIMIT:
 				case self::QRCODE_TYPE_LIMIT_STR:
 					$data_arr['action_name'] = $action_name;
 					$data_arr['action_info']['scene']['scene_id'] = $content;
 					break;
 			}
 			//对结果进行编码,变成json格式
 			$data = json_encode($data_arr);
 			//调用函数进行发送
 			$result = $this ->_requestPost($url,$data);
 			//判断
 			if(!$result){
 				return false;
 			}
 			//存在
 			$result_obj = json_decode($result);//解码
 			//返回ticket
 			return $result_obj ->ticket;
 		}

 		public function getQRCode($content,$file=NULL,$type=1,$expire=604800){
 			//获取ticket
 			$ticket = $this ->getQRCodeTicket($content,$type=1,$expire=604800);
 			//获取url
 			$url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
 			$result = $this ->_requestGet($url);
 			if($file){
 				file_put_contents($file,$result);//$file是用户输入的地址
 			}else{
 				ob_start();
				header("content-type:image/jpeg");
				echo $result; 	 				
 			}
 		}

 		public function _requestPost($url,$data=array(),$ssl=true){
 			//开启curl拓展
 			$curl = curl_init();//初始化资源

 			curl_setopt($curl, CURLOPT_URL,$url);//请求url
 			//请求代理信息,有就使用,没有就默认一个
 			$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0";
 			curl_setopt($curl,CURLOPT_USERAGENT,$user_agent);

 			//referer请求头信息
 			curl_setopt($curl,CURLOPT_AUTOREFERER,true);

 			//ssl相关设置
 			if($ssl){
 				//禁止后url将终止从服务器端进行验证,因为相信服务器端
 				curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
 				//设置成 2，会检查公用名是否存在，并且是否与提供的主机名匹配。 在生产环境中，这个值应该是 2（默认值）。
 				curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
 			}
 			//处理POST请求
 			curl_setopt($curl,CURLOPT_POST,true);//是否为post请求
 			curl_setopt($curl,CURLOPT_POSTFIELDS,$data);//处理请求信息
 			//是否处理响应头
 			curl_setopt($curl,CURLOPT_HEADER,false);
 			//是否返回响应结果
 			curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

 			//发出请求exec()
 			$response = curl_exec($curl);
 			if($response===false){
 				return false;
 			}
 			return $response;
 		}


 		private function _requestGet($url,$ssl=true){
 			//开启curl拓展
 			$curl = curl_init();//初始化资源

 			curl_setopt($curl, CURLOPT_URL,$url);//请求url

 			//请求代理信息,有就使用,没有就默认一个
 			$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0";
 			curl_setopt($curl,CURLOPT_USERAGENT,$user_agent);

 			//referer请求头信息
 			curl_setopt($curl,CURLOPT_AUTOREFERER,true);

 			//ssl相关设置
 			if($ssl){
 				//禁止后url将终止从服务器端进行验证,因为相信服务器端
 				curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
 				//设置成 2，会检查公用名是否存在，并且是否与提供的主机名匹配。 在生产环境中，这个值应该是 2（默认值）。
 				curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
 			}
 			//是否处理响应头
 			curl_setopt($curl,CURLOPT_HEADER,false);
 			//是否返回响应结果
 			curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

 			//发出请求exec()
 			$response = curl_exec($curl);
 			if($response===false){
 				return false;
 			}
 			return $response;
 		}
 	}



 ?>