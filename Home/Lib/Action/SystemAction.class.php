<?php
	class SystemAction extends Action{
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
		*获取系统的设置
		*/
		public function showSystemSet(){
			$this->CheckSession();
			import("Home.Action.System.SystemBasicOperate");
			$sysOp = new SystemBasicOperate();
			$identity = $_SESSION['identity'];
				if($identity == 4 ||  $identity == "4"){
				$result = $sysOp->getSystemSet();
				$this->assign("systemSet",$result);
				$this->display("Root:TimeSet");       //还要做页面的渲染
			}else{
				$this->error("你没有权限查看信息");
				return;
			}
		}

		/*
		*俞鹏泽
		*修改系统设置
		*/
		public function updateSystemSet(){
			$this->CheckSession();
			import("Home.Action.System.SystemBasicService");
			$sysOp = new SystemBasicService();

			$identity = $_SESSION['identity'];
			if($identity == 4 ||  $identity == "4"){
				$result = $sysOp->updateSystemSetInfo($_POST);
				if($result['status']){
					$this->success("参数更新成功",U('System/showSystemSet'));
				}else{
					$this->error("参数更新失败",U('System/showSystemSet'));
				}
			}else{
				$this->error("你没有权限修改系统信息");
				return;
			}
		}

	}
 ?>
