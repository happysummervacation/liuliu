<?php
	class UserBasicService extends Action{
		private $imageType = array('jpg', 'gif', 'png', 'jpeg');
		private $fileSize = 5242880;
		private $userImagePath = './UserImage/';
		/*
		*俞鹏泽
		*学生的信息的更新
		*/
		public function updateStudentInfo($StudentID = null,$StudentAccount = null,$postData = null,$fileData = null){
			$message = array();
			if(is_null($StudentID) && is_null($StudentAccount)){
				$message['status'] = false;
				$message['message'] = "用户的ID与账号都是空的,更新失败";
				return $message;
			}
			if(is_null($postData) && is_null($fileData)){
				$message['status'] = false;
				$message['message'] = "用户要更新的数据没有,更新失败";
				return $message;
			}

			$filePath = null;
			if($fileData){
				$filePath = UploadOneFile($this->userImagePath,$this->fileSize,$this->imageType);
				if($filePathp['status']){
					$message['status'] = false;
					$message['message'] = "用户要更新的数据失败";
					return $message;
				}
			}

			$data = array();
			$data['chinesename'] = $postData['chinesename'];
			$data['englishname'] = $postData['englishname'];
			$data['age'] = $postData['age'];
			$data['sex'] = $postData['sex'];
			$data['email'] = $postData['email'];
			$data['phone'] = $postData['phone'];
			$data['QQ'] = $postData['qq'];
			$data['weixin'] = $postData['weixin'];
			$data['skype'] = $postData['skype'];
			$data['country'] = $postData['country'];

			if(!is_null($filePath)){
				$data['image_path'] = '/liuliu'.explode(".",$filePath['message'][0]['savepath'])[1].$filePath['message'][0]['savename'];
			}

			import("Home.Action.User.UserBasicOperate");
			$UserOp = new UserBasicOperate();

			$result = $UserOp->updateUserInfo($StudentID,$StudentAccount,$data);

			return $result;
		}

		/*
		*俞鹏泽
		*教师的信息的更新
		*/
		public function updateTeacherInfo($TeacherID = null,$TeacherAccount = null,$postData = null,$fileData = null){
			$message = array();
			if(is_null($TeacherID) && is_null($TeacherAccount)){
				$message['status'] = false;
				$message['message'] = "用户的ID与账号都是空的,更新失败";
				return $message;
			}
			if(is_null($postData) && is_null($fileData)){
				$message['status'] = false;
				$message['message'] = "用户要更新的数据没有,更新失败";
				return $message;
			}

			$filePath = null;
			if($fileData){
				$filePath = UploadOneFile("$this->userImagePath",$this->fileSize,$this->imageType);
				if($filePathp['status']){
					$message['status'] = false;
					$message['message'] = "用户要更新的数据失败";
					return $message;
				}
			}

			$data = array();
			$data['chinesename'] = $postData['chinesename'];
			$data['englishname'] = $postData['englishname'];
			$data['age'] = $postData['age'];
			$data['sex'] = $postData['sex'];
			$data['email'] = $postData['email'];
			$data['phone'] = $postData['phone'];
			$data['QQ'] = $postData['qq'];
			$data['weixin'] = $postData['weixin'];
			$data['skype'] = $postData['skype'];
			$data['country'] = $postData['country'];
			$data['zoom'] = $postData['zoom'];
			$data['bankcard'] = $postData['bankcard'];
			$data['paypal'] = $postData['paypal'];
			if(!empty($postData['introduction'])){
				$data['introduction'] = $postData['introduction'];
			}
			if(!empty($postData['teachercomment'])){
				$data['teachercomment'] = $postData['teachercomment'];
			}

			if(!is_null($filePath)){
				$data['image_path'] = '/liuliu'.
				explode(".",$filePath['message'][0]['savepath'])[1].$filePath['message'][0]['savename'];
			}

			import("Home.Action.User.UserBasicOperate");
			$UserOp = new UserBasicOperate();

			$result = $UserOp->updateUserInfo($TeacherID,$TeacherAccount,$data);

			return $result;
		}

		/*
		*俞鹏泽
		*root的信息的更新
		*/
		public function updateRootInfo($RootID = null,$RootAccount = null,$postData = null,$fileData = null){
			$message = array();
			if(is_null($RootID) && is_null($RootAccount)){
				$message['status'] = false;
				$message['message'] = "用户的ID与账号都是空的,更新失败";
				return $message;
			}
			if(is_null($postData) && is_null($fileData)){
				$message['status'] = false;
				$message['message'] = "用户要更新的数据没有,更新失败";
				return $message;
			}

			$data = array();
			$data['chinesename'] = $postData['chinesename'];
			$data['englishname'] = $postData['englishname'];
			$data['email'] = $postData['email'];
			$data['phone'] = $postData['phone'];

			import("Home.Action.User.UserBasicOperate");
			$UserOp = new UserBasicOperate();

			$result = $UserOp->updateUserInfo($RootID,$RootAccount,$data);

			return $result;
		}

		/*
		*蒋周杰
		*更新admin的数据
		*/
		public function updateAdminInfo($AdminID = null,$AdminAccount = null,$postData = null){
			$message = array();

			if(is_null($AdminID) && is_null($AdminAccount)){
				$message['status'] = false;
				$message['message'] = "用户的ID与账号都是空的,更新失败";
				return $message;
			}
			if(is_null($postData)){
				$message['status'] = false;
				$message['message'] = "用户要更新的数据没有,更新失败";
				return $message;
			}

			$data = array();
			$data['chinesename'] = $postData['chinesename'];
			$data['englishname'] = $postData['englishname'];
			$data['age'] = $postData['age'];
			$data['sex'] = $postData['sex'];
			$data['email'] = $postData['email'];
			$data['phone'] = $postData['phone'];
			$data['QQ'] = $postData['qq'];
			$data['weixin'] = $postData['weixin'];
			$data['country'] = $postData['country'];

			import("Home.Action.User.UserBasicOperate");
			$UserOp = new UserBasicOperate();

			$result = $UserOp->updateUserInfo($AdminID,$AdminAccount,$data);

			return $result;
		}

		/*
		*俞鹏泽
		*增加root的操作
		*/
		public function addRootInfo($postData = null){
			$message = array();
			//先做密码相同的判断
			if($postData['password'] != $postData['check_password']){
				$message['status'] = false;
				$message['message'] = "密码与确认密码不相同";
				return $message;
			}
			//先做手机,email,账号相同的判断
			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();

			$data['email'] = $postData['email'];
			$data['phone'] = $postData['phone'];
			$data['account'] = $postData['account'];
			$result = $userOp->CountUserFieldData($data);
			if((int)$result[0]['email'] > 0){
				$message['status'] = false;
				$message['message'] = "邮箱重复";
				return $message;
			}elseif((int)$result[0]['phone'] > 0){
				$message['status'] = false;
				$message['message'] = "手机号重复";
				return $message;
			}elseif((int)$result[0]['phone'] > 0){
				$message['status'] = false;
				$message['message'] = "手机号重复";
				return $message;
			}else{
				$data['QQ'] = $postData['qq'];
				$data['chinesename'] = $postData['name'];
				$data['sex'] = $postData['sex'];
				$data['password'] = md5($postData['password']);
				$data['status'] = 1;
				$data['identity'] = 4;
				$result = $userOp->addUser($data);
				if($result['status']){
					$message['status'] = true;
					$message['message'] = "用户创建成功";
					return $message;
				}else{
					$message['status'] = false;
					$message['message'] = "用户创建失败";
					return $message;
				}
			}
		}

		/*
		*俞鹏泽
		*增加root的操作
		*/
		public function addAdminInfo($postData = null){
			$message = array();
			//先做密码相同的判断
			if($postData['password'] != $postData['check_password']){
				$message['status'] = false;
				$message['message'] = "密码与确认密码不相同";
				return $message;
			}
			//先做手机,email,账号相同的判断
			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();

			$data['email'] = $postData['email'];
			$data['phone'] = $postData['phone'];
			$data['account'] = $postData['account'];
			$result = $userOp->CountUserFieldData($data);
			if((int)$result[0]['email'] > 0){
				$message['status'] = false;
				$message['message'] = "邮箱重复";
				return $message;
			}elseif((int)$result[0]['phone'] > 0){
				$message['status'] = false;
				$message['message'] = "手机号重复";
				return $message;
			}elseif((int)$result[0]['phone'] > 0){
				$message['status'] = false;
				$message['message'] = "手机号重复";
				return $message;
			}else{
				$data['QQ'] = $postData['qq'];
				$data['chinesename'] = $postData['name'];
				$data['sex'] = $postData['sex'];
				$data['password'] = md5($postData['password']);
				$data['status'] = 1;
				$data['identity'] = 2;
				$result = $userOp->addUser($data);
				if($result['status']){
					$message['status'] = true;
					$message['message'] = "用户创建成功";
					return $message;
				}else{
					$message['status'] = false;
					$message['message'] = "用户创建失败";
					return $message;
				}
			}
		}

		/*
		*俞鹏泽
		*添加教师
		*/
		public function addTeacherInfo($postData = null){
			$message = array();
			//先做密码相同的判断
			if($postData['password'] != $postData['check_password']){
				$message['status'] = false;
				$message['message'] = "密码与确认密码不相同";
				return $message;
			}
			//先做手机,email,账号相同的判断
			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();

			$data['email'] = $postData['email'];
			$data['phone'] = $postData['phone'];
			$data['account'] = $postData['account'];
			$result = $userOp->CountUserFieldData($data);

			if((int)$result[0]['email'] > 0){
				$message['status'] = false;
				$message['message'] = "邮箱重复";
				return $message;
			}elseif((int)$result[0]['phone'] > 0){
				$message['status'] = false;
				$message['message'] = "手机号重复";
				return $message;
			}elseif((int)$result[0]['phone'] > 0){
				$message['status'] = false;
				$message['message'] = "手机号重复";
				return $message;
			}else{
				$data['teacher_type'] = $postData['teacher_type'];
				$data['country'] = $postData['country'];
				$data['password'] = md5($postData['password']);
				$data['status'] = 1;
				$data['identity'] = 1;
				$result = $userOp->addUser($data);

				if($result['status']){
					$message['status'] = true;
					$message['message'] = "用户创建成功";
					return $message;
				}else{
					$message['status'] = false;
					$message['message'] = "用户创建失败";
					return $message;
				}
			}
		}

		/*
		*蒋周杰
		*获取admin自己分管的学生
		*/
		public function getMystudentInfo($adminID){
			if(is_null($adminID)){
				return null;
			}
			$inquiry = new Model('student');
			$result = $inquiry->where("student_manage_id = {$adminID}")->select();
			return $result;
		}

		/*
		蒋周杰
		查询所有的0中教1外教null所有教师
		*/
		public function getTeacherList($teacher_type = null){
			$inquiry = new Model("teacher");
			if(is_null($teacher_type)){
				$result = $inquiry->where("status = 1")->select();
			}else{
				$result = $inquiry->where("status = 1 and
					teacher_type = {$teacher_type}")
				->select();
			}
			return $result;
		}
	}
 ?>
