<?php
	class MoneyAction extends Action{
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

		public function showTeacherMoneySet(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(4 == $identity || "4" == $identity){
				$this->display("Root:SetTeacherPay");
			}else{
				$this->error("你没有权限查看该页面");
			}
		}
	}
 ?>
