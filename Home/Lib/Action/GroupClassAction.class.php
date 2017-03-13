<?php
	class GroupClassAction extends Action{
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
		*用于外部访问时的小班课程时的接口
		*/
		public function GroupClassRecode(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(2 == $identity || '2' == $identity){

			}elseif(4 == $identity || '4' == $identity){
				$this->display("Root:GroupClassRecode");
			}else{
				$this->error("你没有权限访问该网页");
			}
		}
	}
