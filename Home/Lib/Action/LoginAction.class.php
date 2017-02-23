<?php
	class LoginAction extends Action{
		public function _empty(){
        	echo "访问路径出错";
        }

        //调用默认方法时，跳到登录界面
        public function index(){
        	$this->redirect('Login/Login');
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
		*显示登录页面
		*/
		public function Login(){
			$this->display();
		}

		/*
		*显示注册页面
		*/
		public function Register(){
			$this->display();
		}

		/*
		*进行用户注册的操作
		*/
		public function registerUser(){
			$data = array();

		    $data['account'] = $this->_post("account","trim");
			$data['password'] = md5($this->_post("password","trim"));
			$checkPassword = md5($this->_post("checkPassword","trim"));
			$data['phone'] = $this->_post("phoneNumber","trim");
			$data['email'] = $this->_post("email","trim");
			$data['identity'] = 0;
			$data['status'] = 1;

			if($checkPassword != $data['password']){
				$this->error("密码与确认密码不相同");
				return;
			}

			/*判断该账号,该手机号,该邮箱是否已经存在*/
			import("Home.Action.User.UserBasicOperate");
			$field = array();
			$field['account'] = $data['account'];
			$field['email'] = $data['email'];
			$field['phone'] = $data['phone'];

			$userObject = new UserBasicOperate();
			$result = $userObject->CountUserFieldData($field);

			if((int)$result[0]['account'] > 0){
				$this->error("注册失败,有相同的账号");
				return;
			}else if((int)$result[0]['phone'] > 0){
				$this->error("注册失败,有相同的手机号");
				return;
			}else if((int)$result[0]['email'] > 0){
				$this->error("注册失败,有相同的邮箱");
				return;
			}else{
				$registerResult = $userObject->addUser($data);
				if($registerResult['status']){
					$this->success('注册成功');
				}else{
					$this->error('注册失败');
				}
			}

		}

		/*
		*俞鹏泽
		*做登录操作
		*/
		public function DoLogin(){
			$account = $this->_post('account','trim');
			$password = $this->_post('password','trim');

			import("Home.Action.User.UserBasicOperate");

			$selectResult = new UserBasicOperate();
			$result = $selectResult->getUserInfo("register",null,$account);

			if($result[0]['password'] != md5($password)){
				$this->error("登录失败");
				return;
			}else{
				/*在session中设置必要的用户信息*/
				$_SESSION['ID'] = $result[0]['ID'];
				$_SESSION['account'] = $result[0]['account'];
				$_SESSION['email'] = $result[0]['email'];
				$_SESSION['phone'] = $result[0]['phone'];
				$_SESSION['identity'] = $result[0]['identity'];

				/*进行页面的跳转*/
				if($result[0]['identity'] == "0" || $result[0]['identity'] == 0){
					$this->display("Student:index");
				}elseif($result[0]['identity'] == "1" || $result[0]['identity'] == 1){
					$this->display("Teacher:index");
				}elseif($result[0]['identity'] == "2" || $result[0]['identity'] == 2){
					$this->display("Admin:index");
				}elseif($result[0]['identity'] == "3" || $result[0]['identity'] == 3){

				}elseif($result[0]['identity'] == "4" || $result[0]['identity'] == 4){
					$this->display("Root:index");
				}else{
					$this->error("没有该身份的用户");
					return;
				}
			}
		}

		/*
		*俞鹏泽
		*用户的登出操作
		*/
		public function doLogout(){
			$this->CheckSession();
			//清空session中的值
			unset($_SESSION['ID']);
			unset($_SESSION['account']);
			unset($_SESSION['email']);
			unset($_SESSION['phone']);
			unset($_SESSION['identity']);
			//销毁session值
			session('[destroy]');
			$this->redirect('Login/Login');
		}
	}
 ?>
