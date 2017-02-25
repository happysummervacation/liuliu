<?php
	class InfoAction extends Action{

		private $resetNewPassword = "123456";

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
			if($identity == 0 || $identity == "0"){   //学生
				$result = $userOp->getUserInfo("student",$_SESSION['ID']);
				$this->assign('data',$result[0]);
				$this->display("Student:Information");
			}elseif($identity == 1 || $identity == "1"){
				$result = $userOp->getUserInfo("teacher",$_SESSION['ID']);
				$this->assign('data',$result[0]);
				$this->display("Teacher:Information");
			}elseif($identity == 2 || $identity == "2"){
				$result = $userOp->getUserInfo("admin",$_SESSION['ID']);
				$this->assign('data',$result[0]);
				$this->display("Admin:Information");
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
				if($_FILES['photo']['size'] > 0){   //有图片的上传
					$result = $userObject->updateTeacherInfo($_SESSION['ID'],null,$_POST,true);
				}else{   //没有图片的上传
					$result = $userObject->updateTeacherInfo($_SESSION['ID'],null,$_POST,false);
				}
			}elseif($identity == 2 || $identity == '2'){
				$result = $userObject->updateAdminInfo($_SESSION['ID'],null,$_POST,false);
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
				$this->display("Teacher:ResetPassword");
			}elseif($identity == 2 || $identity == "2"){
				$this->display("Admin:ResetPassword");
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
				$this->success("密码更新成功",U('Info/resetPassword'));
			}else{
				$this->error("密码更新失败",U('Info/resetPassword'));
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
			import("Home.Action.User.UserBasicOperate");
			$userBasOp = new UserBasicOperate();
			$userOp = new UserBasicService();

			$type = $_GET['type'];
			$person = $_GET['person'];

			$identity = $_SESSION['identity'];

			if($identity == 4 || $identity == "4"){
				if($type == "add"){     //添加用户的操作
					if($person == "teacher"){   //添加的用户类型为教师
						$result = $userOp->addTeacherInfo($_POST);
						if($result['status']){
							$this->success($result['message']);
						}else{
							$this->error($result['message']);
						}
					}elseif($person == "admin"){    //添加的用户类型为课程顾问
						$result = $userOp->addAdminInfo($_POST);
						if($result['status']){
							$this->success($result['message']);
						}else{
							$this->error($result['message']);
						}
					}elseif($person == "root"){    //添加的用户类型为最高管理员
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
				}elseif($type == "delete"){        //删除用户
					$userID = $_GET[''];
					$result = $userBasOp->$userBasOp($userID);
					if($result['status']){
						$this->success("用户已经删除",U(''));
					}else{
						$this->error('用户删除失败',U(''));
					}
				}elseif($type == "update"){        //更新用户信息

				}elseif($type == "resetPassword"){   //重置用户的密码
					$data = array();
					$data['password'] = md5($this->resetNewPassword());
					$result = $userBasOp->updateUserInfo($userID,null,$data);
					if($result['status']){
						$this->success("密码已经重置,新的密码为{$this->resetNewPassword}",U(''));
						return;
					}else{
						$this->error("密码重置失败,请重试",U(''));
						return;
					}
				}elseif($type == "resetStatus"){     //修改用户的状态
					$data = array();
					$status = $_GET[''];
					$data['status'] = $status;
					$result = $userBasOp->updateUserInfo($userID,null,$data);
					if($result['status']){
						$this->success("用户状态更改成功",U(''));
						return;
					}else{
						$this->error("用户状态更改失败",U(''));
						return;
					}
				}else{
					$this->error("没有对应的操作");
				}
				return;
			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}

		/*
		*俞鹏泽
		*联系课程顾问
		*/
		public function contractAdmin(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(1 == $identity || "1" == $identity){
				//////////////////////////////////////

				/////////////////////////////////////
				$this->display("Teacher:ContractAdmin");
			}elseif(0 == $identity || "0" == $identity){

			}else{
				$this->error("你没有权限查看该页面");
			}
		}

		/*
		*俞鹏泽
		*管理员和课程顾问管理,用来展示被管理人员的信息
		*/
		public function showManagedUser(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			$type = $_GET['personType'];
			if(4 == $identity || "4" == $identity){
				if("student" == $type){

				}elseif("teacher" == $type){
					$this->display("Root:CheckTeacher");
				}elseif("admin" == $type){

				}else{
					$this->error("");
				}
			}elseif(2 == $identity || "2" == $identity){
				if("student" == $type){
					
				}elseif("teacher" == $type){

				}else{
					$this->error("");
				}
			}else{
				$this->error("你没有该权限查看该信息");
			}
		}

	}
 ?>
