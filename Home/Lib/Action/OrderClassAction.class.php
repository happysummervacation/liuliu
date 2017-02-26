<?php
	class OrderClassAction extends Action{
		private $systemSet = null;
		public function __construct(){
            //获取系统设置
            $field = array();
            import("Home.Action.System.SystemBasicOperate");
			$sysOp = new SystemBasicOperate();
            $result = $sysOp->getSystemSet();
			$this->systemSet = $result;
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
		*显示订购课程的页面
		*/
		public function showOrderClassInfo(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(0 == $identity || "0" == $identity){       //获取教师的必要数据进行展示
				//////////////////////////////////

				/////////////////////////////////
				$this->display("Student:BookCourse");
			}elseif(2 == $identity || "2" == $identity){

			}elseif(4 == $identity || "4" == $identity){

			}else{
				$this->error("你没有权限查看该页面的内容");
				return;
			}
		}
	}
 ?>
