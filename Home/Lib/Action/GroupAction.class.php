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
			$this->CheckSession();
			$identity = $_SESSION['identity'];
			import("Home.Action.Group.GroupBasicService");
			import("Home.Action.GlobalValue.GlobalValue");
			import("Home.Action.Package.PackageBasicOperate");
			if(2 == $identity || '2' == $identity){

				$packageBo = new PackageBasicOperate();
				$groupBS = new GroupBasicService();
				//获取所有active的小班
				$result = $groupBS->getGroupClassInfo(null,GlobalValue::active);

				//获取小班课套餐信息
				$packageInfo = $packageBo->getGroupPackageInfo(1);
				$this->assign("classList",$result);
				$this->assign("packageList",$packageInfo);
				$this->display("Admin:GroupManage");
			}elseif(4 == $identity || '4' == $identity){
				$packageBo = new PackageBasicOperate();
				$groupBS = new GroupBasicService();
				//获取所有active的小班
				$result = $groupBS->getGroupClassInfo(null,GlobalValue::active);

				//获取小班课套餐信息
				$packageInfo = $packageBo->getGroupPackageInfo(1);
				$this->assign("classList",$result);
				$this->assign("packageList",$packageInfo);
				$this->display("Root:GroupManage");
			}else{
				$this->error("你没有权限访问该网页");
			}
		}



		public function GroupStudentManage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			import("Home.Action.Group.GroupBasicService");
			import("Home.Action.GlobalValue.GlobalValue");
			$groupBS = new GroupBasicService();

			if(2 == $identity || '2' == $identity){

			}elseif(4 == $identity || '4' == $identity){
				$groupID = $_GET['groupID'];
				//得到学生列表
				$studentList = $groupBS->getGroupStudentInfo($groupID,GlobalValue::active);
				$this->assign("studentList",$studentList);
				$this->display("Root:GroupStudentManage");
			}else{
				$this->error("你没有权限访问该网页");
			}
		}

		public function GroupHistory(){
			$this->CheckSession();
			import("Home.Action.Group.GroupBasicService");
			import("Home.Action.GlobalValue.GlobalValue");
			$identity = $_SESSION['identity'];
			if(2 == $identity || '2' == $identity){

				$groupBS = new GroupBasicService();
				//获取所有ever的小班
				$result = $groupBS->getGroupClassInfo(null,GlobalValue::ever);
				$this->assign("classList",$result);
				$this->display("Root:GroupHistory");
			}elseif(4 == $identity || '4' == $identity){

				$groupBS = new GroupBasicService();
				//获取所有ever的小班
				$result = $groupBS->getGroupClassInfo(null,GlobalValue::ever);
				$this->assign("classList",$result);

				$this->display("Root:GroupHistory");
			}else{
				$this->error("你没有权限访问该网页");
			}
		}

		/*
		*蒋周杰
		*创建小班的操作
		*/
		public function CreateGroup(){
			$identity = $_SESSION['identity'];
			if(4 == $identity || "4" == $identity){
				//获取上传上来的信息
				$packageID = $_POST['packageID'];
				$teacherID = $_POST['teacherID'];
				$teacherSalary = $_POST['teacherSalary'];
				$dateList =explode(",",$_POST['times']);
				$groupName = $_POST['groupName'];
				import("Home.Action.Group.GroupBasicService");
				import("Home.Action.GroupClassSch.GroupClassSchBasicService");
				$groupBS = new GroupBasicService();
				$gcsBS = new GroupClassSchBasicService();

				//开启事务
				$inquiry = new Model();
				$inquiry->startTrans();

				/*添加小班*/
				$groupresult = $groupBS->AddGroupService($packageID,$groupName);
				//获取groupID
				$groupID = $groupresult['other'];

				/*添加小班课程*/
				foreach ($dateList as $key => $value) {
					//教师开课
					$teaClassresult = $gcsBS->addGroupClass($teacherID,$value);

					if(!$teaClassresult['status']){
						break;
					}
					//小班选课
					$addClassresult = $gcsBS->addOneGroupClassInfo($groupID,$teaClassresult['other']);

					if(!$addClassresult['status']){
						break;
					}
				}


				/*添加教师薪资数据*/
				import("Home.Action.Money.TeaSalaryService");
				$teaSS = new TeaSalaryService();
				$salaryresult = $teaSS->addGroupClassSalary($teacherID,$groupID,$teacherSalary);
				//结果反馈
				if($groupresult['status']&&$teaClassresult['status']&&$addClassresult['status']&&$salaryresult['status']){
					$inquiry->commit();
					$this->success("小班创建成功！");
				}else{
					$inquiry->rollback();
					if(!$teaClassresult['status']){
						$this->error("教师时间段冲突！");
					}else{
						$this->error("无法创建小班！");
					}
				}
			}else{
				$this->error("你没有权限访问该网页");
			}
		}

		/*
		*蒋周杰
		通过ajax获取小班的可选教师
		*/
		public function ajaxGetTeacherInfo(){
			$identity = $_SESSION['identity'];
			if(4 == $identity || "4" == $identity){
				$packageID = $_POST['package_id'];
				import("Home.Action.Group.GroupBasicService");
				$groupBS = new GroupBasicService();
				$teacherList = $groupBS->getGroupTeacherList($packageID);
				echo json_encode($teacherList);
			}
		}
	}
