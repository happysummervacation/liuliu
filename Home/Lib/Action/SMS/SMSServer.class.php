<?php
	class SMSServer{
		//参数一：手机号码、
		//参数二：要发送的文本内容
		public static function PostSMS($phonenumber,$txt){
			$url='http://utf8.sms.webchinese.cn/?Uid=*?*&Key=*??*&smsMob=*???*&smsText=*????*';
			$uid = C('UID');
			$key = C('KEY');

			if(!($uid && $key)){
				return false;
				exit;
			}

			//进行数据替换
			$url = str_replace("*?*", $uid, $url);
			$url = str_replace("*??*", $key, $url);
			$url = str_replace("*???*", $phonenumber, $url);
			$url = str_replace("*????*", $txt, $url);

			$file_contents = false;  //默认是发送失败
			if(function_exists('file_get_contents'))
			{
				$file_contents = file_get_contents($url);
			}
			else
			{
				$ch = curl_init();
				$timeout = 5;
				curl_setopt ($ch, CURLOPT_URL, $url);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  //连接前要等待的时间，对过载，下线情况有用
				$file_contents = curl_exec($ch);
				curl_close($ch);
			}

			return $file_contents;
	}
}
