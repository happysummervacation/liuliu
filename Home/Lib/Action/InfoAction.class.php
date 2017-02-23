<?php
	class InfoAction extends Action{

		public function __construct(){
            //获取系统设置
            // $field = array();
            // array_push($field, "studentcancelrate");
            // import("Home.Action.System.SystemOperate");
            // $result = SystemOperate::GetSystemSet($field);
            // $this->CancelClassRate = $result['studentcancelrate'];
        }

		//空操作访问
        public function _empty(){
            echo "访问路径出错";
        }

		//不仅要查看登录的用户名，还要查看登录者的身份
	    public function CheckSession(){
			if(isset($_SESSION['account']) && $_SESSION['account']!='' && !is_null($_SESSION['identity'])){
				;
			}else{
				$this->error('请先登录',U('Login/Login'));
				return;
			}
		}

		/*
		*俞鹏泽
		*接受来自学生,教师,课程顾问,最高管理员的关于信息的请求
		*/
		//1.先判断是哪种类型的用户
		//2.根据不同类型的用户进行不同用户页面的展示
		public function Information(){
			$this->CheckSession();
			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();

			$identity = $_SESSION['identity'];
			if($identity == 0 || $identity == "0"){
				$result = $userOp->getUserInfo("student",$_SESSION['ID']);
				$this->assign('data',$result[0]);
				$this->display("Student:Information");
			}elseif($identity == 1 || $identity == "1"){
				$this->display("Teacher:index");
			}elseif($identity == 2 || $identity == "2"){
				$this->display("Admin:index");
			}elseif($identity == 4 || $identity == "4"){
				$result = $userOp->getUserInfo("root",$_SESSION['ID']);
				$this->assign('data',$result[0]);
				$this->display("Root:Information");
			}else{
				$this->error("不存在该用户的页面");
				return;
			}
		}

		public function ChangeUserInformation(){
			$this->CheckSession();

			import("Home.Action.User.UserBasicService");
			$userObject = new UserBasicService();

			$identity = $_SESSION['identity'];

			if($identity == 0 || $identity == '0'){
				if($_FILES['photo']['size'] > 0){   //有图片的上传
					$result = $userObject->updateStudentInfo($_SESSION['ID'],null,$_POST,true);
				}else{   //没有图片的上传
					$result = $userObject->updateStudentInfo($_SESSION['ID'],null,$_POST,false);
				}
			}elseif($identity == 1 || $identity == '1'){

			}elseif($identity == 2 || $identity == '2'){

			}elseif($identity == 4 || $identity == '4'){
				$result = $userObject->updateRootInfo($_SESSION['ID'],null,$_POST,false);
			}else{
				$this->error("不存在该类型的用户,更新失败");
				return;
			}
			if($result['status']){
				$this->success("信息更新成功",U('Info/Information'));
			}else{
				$this->error("信息更新失败",U('Info/Information'));
			}
		}

		/*
		*俞鹏泽
		*显示用户的修改信息的界面
		*/
		public function resetPassword(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if($identity == 0 || $identity == "0"){
				$this->display("Student:ResetPassword");
			}elseif($identity == 1 || $identity == "1"){
				$this->display("Teacher:index");
			}elseif($identity == 2 || $identity == "2"){
				$this->display("Admin:index");
			}elseif($identity == 4 || $identity == "4"){
				$this->display("Root:Information");
			}else{
				$this->error("不存在该用户的页面");
				return;
			}
		}

		public function ChangePassword(){
			$this->CheckSession();

			import("Home.Action.User.UserBasicOperate");
			$userObject = new UserBasicOperate();

			$identity = $_SESSION['identity'];

			if($_POST['CheckNewPassword'] != $_POST['NewPassword']){
				$this->error("密码与确认密码不相同");
				return;
			}

			$userID = $_SESSION['ID'];

			$selectResult = $userObject->getUserInfo('register',$userID);
			if($selectResult[0]['password'] == md5($_POST['OldPassword'])){
				$data['password'] = md5($_POST['NewPassword']);
				$result = $userObject->updateUserInfo($_SESSION['ID'],null,$data);
			}else{
				$this->error("旧密码不相同");
				return;
			}

			if($result['status']){
				$this->success("密码更新成功",U('Info/Information'));
			}else{
				$this->error("密码更新失败",U('Info/Information'));
			}
		}

		/*
		*俞鹏泽
		*用来做创建用户页面的创建
		*/
		public function showCreateUser(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			$type = $_GET['personType'];
			if($identity == 4 || $identity == "4"){
				if($type == "teacher"){
					$this->display("Root:CreateTeacher");
				}elseif($type == "admin"){
					$this->display("Root:CreateAdmin");
				}elseif($type == "root"){
					$this->display("Root:CreateRoot");
				}else{
					$this->error("不存在该页面");
				}

				return;
			}else{
				$this->error("你没有权限进行页面查看操作");
				return;
			}
		}

		/*
		*俞鹏泽
		*用户数据的操作
		*/
		public function UserManage(){
			$this->CheckSession();
			import("Home.Action.User.UserBasicService");
			$userOp = new UserBasicService();

			$type = $_GET['type'];
			$person = $_GET['person'];

			$identity = $_SESSION['identity'];

			if($identity == 4 || $identity == "4"){
				if($type == "add" || $type == "0"){
					if($person == "teacher"){

					}elseif($person == "admin"){
						$result = $userOp->addAdminInfo($_POST);
						if($result['status']){
							$this->success($result['message']);
						}else{
							$this->error($result['message']);
						}
					}elseif($person == "root"){
						$result = $userOp->addRootInfo($_POST);
						if($result['status']){
							$this->success($result['message']);
						}else{
							$this->error($result['message']);
						}
					}else{
						$this->error("不能增加该用户信息");
					}
					return;
				}elseif($type == "delete" || $type == "1"){

				}elseif($type == "update" || $type == "2"){

				}else{
					$this->error("没有对应的操作");
				}
				return;
			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}
	}
 ?>
