<?php
	class PackageAction extends Action{
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

		public function packageShow(){
			$this->CheckSession();
			import("Home.Action.Package.PackageConfigBasicOperate");
			$configOp = new PackageConfigBasicOperate();

			$identity = $_SESSION['identity'];
			if($identity == 4 || $identity == "4"){
				$result = $configOp->getPackageConfigInfo();
				$this->assign('packageConfig',$result);
				$this->display("Root:PackageManage");
				return;
			}elseif($identity == 0 || $identity = "0"){

			}else{
				$this->error("你没有权限查看该页面内容");
				return;
			}
		}

		public function packageManage(){
			$this->CheckSession();
			import("Home.Action.Package.PackageBasicService");
			$packageOp = new PackageBasicService();

			$type = $_GET['type'];

			$identity = $_SESSION['identity'];
			if($identity == 4 || $identity == "4"){
				if($type == "add" || $type == "0"){
					$result = $packageOp->addPackageInfo($_POST);
					if($result['status']){
						$this->success("添加成功");
					}else{
						$this->error("添加失败");
					}
				}elseif($type == "update" || $type == "1"){
					$result = $packageOp->updatePackageInfo(null,$_POST);
					if($result['status']){
						$this->success("修改成功");
					}else{
						$this->error("修改失败");
					}
				}elseif($type == "delete" || $type == "2"){
					$result = $packageOp->deletePackageInfo(null);
					if($result['status']){
						$this->success("删除成功");
					}else{
						$this->error("删除失败");
					}
				}else{
					$this->error("没有对应的操作");
					return;
				}
			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}
	}
 ?>
