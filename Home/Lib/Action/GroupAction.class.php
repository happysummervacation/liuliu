<?php
	class GroupAction extends Action{
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

		public function GroupManage(){
			import("Home.Action.Group.GroupBasicService");
			import("Home.Action.GroupClassSch.GroupClassSchBasicService");
			import("Home.Action.GroupClassSch.GroupClassSchCountService");
			import("Home.Action.GlobalValue.GlobalValue");

			// $groBasicOp = new GroupBasicService();
			// $groClassBasicOp = new GroupClassSchBasicService();
			// $groClassCountOp = new GroupClassSchCountService();
			// $result = $groClassCountOp->countGroupClassWithStatus(1,GlobalValue::notClass.":".GlobalValue.haveClass);
			// $result = $groClassBasicOp->addOneGroupClassInfo(1,"e5ce31ad9690bbc45d93ccf8376622d6");
			// $result = $groClassCountOp->countGroupClassWithTeacherStatus(1,7,GlobalValue::notClass);
			// $groBasicOp->AddGroupService(4,3);
			// dump($result);
			// exit;
			$this->display("Root:GroupManage");
		}



		public function GroupStudentManage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(2 == $identity || '2' == $identity){

			}elseif(4 == $identity || '4' == $identity){
				$this->display("Root:GroupStudentManage");
			}else{
				$this->error("你没有权限访问该网页");
			}
		}

		public function GroupHistory(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if(2 == $identity || '2' == $identity){

			}elseif(4 == $identity || '4' == $identity){
				$this->display("Root:GroupHistory");
			}else{
				$this->error("你没有权限访问该网页");
			}
		}
	}
