<?php
	class UserCenterAction extends Action{
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

		public function index(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if($identity == 0 || $identity == "0"){
				$this->display("Student:index");
			}elseif($identity == 1 || $identity == "1"){
				$this->display("Teacher:index");
			}elseif($identity == 2 || $identity == "2"){
				$this->display("Admin:index");
			}elseif($identity == 4 || $identity == "4"){
				$this->display("Root:index");
			}else{
				$this->error("不存在该用户的页面");
				return;
			}
		}
	}
 ?>
