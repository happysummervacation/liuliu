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
			addWebsiteTime($this);

			if(2 == $identity || '2' == $identity){

			}elseif(4 == $identity || '4' == $identity){
				import("Home.Action.GroupClassSch.GroupClassSchBasicService");
				$groupClassOp = new GroupClassSchBasicService();
				$result = $groupClassOp->getOneGroupClassSchInfo((int)$_GET['groupID']);

				$this->assign("groupClassInfo",$result);
				$this->assign("groupID",$_GET['groupID']);
				$this->display("Root:GroupClassRecode");
			}else{
				$this->error("你没有权限访问该网页");
			}
		}

		/*
		*俞鹏泽
		*表示对小班课程的各种管理
		*/
		public function GroupClassManage(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			$type = $_GET['type'];

			import("Home.Action.GroupClassSch.GroupClassSchBasicService");
			$groupClassOp = new GroupClassSchBasicService();

			if('2' == $identity || 2 == $identity){

			}elseif('4' == $identity || 4 == $identity){
				if("changeStatus" == $type){
					$data['gclassStatus'] = $_POST['status'];
					$groupClassSchID = $_GET['groupClassID'];
					$result = $groupClassOp->updateOneGroupClassSchInfo($groupClassSchID,$data);
					if($result['status']){
						$this->success("状态修改完成");
					}else{
						$this->error("状态修改失败");
					}
				}elseif("getNote" == $type){  //用于获取小班的课程笔记
					$groupClassSchID = $_POST['groupClassSchID'];
					$noteResult = $groupClassOp->getOneGroupClassSchInfo($groupClassSchID,"note")[0]['note'];
					echo "".$noteResult;
				}elseif('teaCancelClass' == $type){
					$groupClassSchID = $_GET['groupClassSchID'];
					$data['gclassStatus'] = 6;  //表示教师退课
					$result = $groupClassOp->updateOneGroupClassSchInfo($groupClassSchID,$data);
					if($result['status']){
						$this->success("教师退课成功");
					}else{
						$this->error("教师退课失败");
					}
				}elseif("addGroupClass" == $type){
					$dateList = $_POST['times'];
					$dateList = json_decode($dateList,true);
					$groupID = $_GET['groupID'];

					//先查询是哪个教师在上该小班课,查询教师的小班薪资表来获取
					import("Home.Action.Money.TeaSalaryService");
					$flag = true;  //用来判断是否添加课程成功
					$teaSalaryOp = new TeaSalaryService();
					$teacherID = $teaSalaryOp->getTeaSalaryWithGroup($groupID,"teacherID")[0]['teacherID'];

					$inquiry = new Model();
					$inquiry->startTrans();

					import("Home.Action.GroupClassSch.GroupClassSchBasicService");
	                $gcsBS = new GroupClassSchBasicService();
					foreach ($dateList as $key => $value) {
						//教师开课
						$teaClassresult = $gcsBS->addGroupClass($teacherID,$value);

						if(!$teaClassresult['status']){
							$flag = false;
						}
						//小班选课
						$addClassresult = $gcsBS->addOneGroupClassInfo($groupID,$teaClassresult['other']);
						if(!$addClassresult['status']){
							$flag = false;
						}
					}
					if($flag){
						// $inquiry->commit();
						echo "添加课程成功";
					}else{
						// $inquiry->rollback();
						echo "添加课程失败";
					}
				}else{
					$this->error("没有对应的操作类型");
				}
			}else{
				$this->error("你没有权限进行操作");
			}
		}




		/*
		蒋周杰
		学生订课
		*/
		public function ajaxOrderGroupClass(){
			$this->CheckSession();
			$ajaxResult = judgeAjaxRequest();
			if(!$ajaxResult){
				echo "非指定访问方式";
				return;
			}

			$identity = $_SESSION['identity'];
			import("Home.Action.GroupStudentClassSch.GroupStuClassSchBasicService");
			$groupSCS = new GroupStuClassSchBasicService();
			if(2 == $identity || '2' == $identity){

			}elseif(4 == $identity || '4' == $identity){
				$classList = json_decode($_POST['classList'],true);
				$studentID = $_POST['student'];
				$packageID = $_POST['packageID'];
				$groupID = $_POST['groupID'];
				foreach ($classList as $key => $value) {
					$result = $groupSCS->addGroupStuClassInfo($studentID,$value,$packageID);
					if(!$result['status']){
						echo "error";
						return ;
					}
				}
				echo "预定课程成功！";
				return ;


			}else{
				$this->error("你没有权限访问该网页");
			}
		}

		/*
		蒋周杰
		退班
		*/
		public function RemoveClass(){
			$this->CheckSession();

			import("Home.Action.GroupStudentClassSch.GroupStuClassSchBasicService");
			$groupSBS = new GroupStuClassSchBasicService();

			$identity = $_SESSION['identity'];
			$groupID = $_GET['groupID'];
			$studentID = $_GET['studentID'];
			if(2 == $identity || '2' == $identity){

			}elseif(4 == $identity || '4' == $identity){
				$result = $groupSBS->deleteStuGroupClass($studentID,$groupID);
				if($result['status']){
					$this->success($result['message']);
				}else{
					$this->error($result['message']);
				}
			}else{
				$this->error("你没有权限访问该网页");
			}
		}
	}
