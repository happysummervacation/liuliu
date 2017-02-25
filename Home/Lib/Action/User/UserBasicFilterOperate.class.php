<?php
	class UserBaiscFilterOperate extends Action{
		/*
		*俞鹏泽
		*根据不同的用户类别过滤数据,提取需要的数据
		*/
		//参数一:要过滤的数据
		//参数二:用户的数据类型,0是学生,1是教师,2是课程顾问,4是root
		public function filterPostData($postData = null,$userType = null){
			$data = array();
			if(is_null($postData)){
				return $data;
			}
			if(is_null($userType)){
				return $data;
			}

			if($userType == 0 || $userType == "0"){
				$data = array();
				$data['chinesename'] = $postData['chinesename'];
				$data['englishname'] = $postData['englishname'];
				$data['age'] = $postData['age'];
				$data['sex'] = $postData['sex'];
				$data['email'] = $postData['email'];
				$data['phone'] = $postData['phonenumber'];
				$data['QQ'] = $postData['qq'];
				$data['weixin'] = $postData['weixin'];
				$data['skype'] = $postData['skype'];
				$data['country'] = $postData['country'];
			}elseif($userType == 1 || $userType == "1"){
				$data = array();
				$data['chinesename'] = $postData['chinesename'];
				$data['englishname'] = $postData['englishname'];
				$data['age'] = $postData['age'];
				$data['sex'] = $postData['sex'];
				$data['email'] = $postData['email'];
				$data['phone'] = $postData['phonenumber'];
				$data['QQ'] = $postData['qq'];
				$data['weixin'] = $postData['weixin'];
				$data['skype'] = $postData['skype'];
				$data['country'] = $postData['country'];
			}elseif($userType == 2 || $userType == "2"){

			}elseif($userType == 4 || $userType == "4"){
				$data = array();
				$data['chinesename'] = $postData['chinesename'];
				$data['englishname'] = $postData['englishname'];
				$data['email'] = $postData['email'];
				$data['phone'] = $postData['phone'];
			}else{
				return $data;
			}

			return $data;

		}
	}
 ?>
