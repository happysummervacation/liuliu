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
			//////////////////////////////////
			/*流程:
			1.获取所有老师的信息(tp_teacher,tp_)
			2.显示到页面上
			*/
			/////////////////////////////////
			$identity = $_SESSION['identity'];

			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();
			import("Home.Action.OrderClass.OrderClassBasicService");
			$orderclassOp = new OrderClassBasicService();

			$result = array();
			$result = $userOp->getUserInfo('teacher');

			/*获取教师的流程
			*1.先对学生是否具有选课权限进行过滤(1.是否有一对一套餐,2.是否停过课,3.一对一套餐的教材是否已经指定)
			*2.根据学生订购的套餐类型来获取可以上课的教师
			*/
			if(0 == $identity || "0" == $identity){       //获取教师的必要数据进行展示
				$studentID = $_SESSION['ID'];
				$filterResult = $orderclassOp->studentOrderClassFilterService($studentID);
				$teacherResult = $orderclassOp->getTeacherWithStudentOrderPac($studentID);
				if(!$filterResult['status']){
					$this->error($filterResult['message']);
					return;
				}
				// $this->assign('teacher_result',$result);
				$this->assign("teacher_result",$teacherResult);
				$this->display("Student:BookCourse");
			}elseif(2 == $identity || "2" == $identity){
				$studentID = $_GET['user_id'];

				$filterResult = $orderclassOp->studentOrderClassFilterService($studentID);
				$teacherResult = $orderclassOp->getTeacherWithStudentOrderPac($studentID);
				if(!$filterResult['status']){
					$this->error($filterResult['message']);
					return;
				}
				$this->assign("studentID",$studentID);
				$this->assign("teacher_result",$teacherResult);
				$this->display("Admin:BookCourse");
			}elseif(4 == $identity || "4" == $identity){
				$studentID = $_GET['user_id'];

				$filterResult = $orderclassOp->studentOrderClassFilterService($studentID);
				$teacherResult = $orderclassOp->getTeacherWithStudentOrderPac($studentID);
				if(!$filterResult['status']){
					$this->error($filterResult['message']);
					return;
				}
				// $this->assign('teacher_result',$result);
				$this->assign("studentID",$studentID);
				$this->assign("teacher_result",$teacherResult);
				$this->display("Root:BookCourse");
			}else{
				$this->error("你没有权限查看该页面的内容");
				return;
			}
		}

		/*
		*俞鹏泽
		*获取学生的订购的课程
		*/
		public function getStudentOrderClassTimeTable(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			import("Home.Action.OrderClass.OrderClassBasicService");
			$ocBS = new OrderClassBasicService();

			/*
			*如果是学生,查看自己的一对一课程或者小班课的课程
			*如果是课程顾问或者管理员,查询学生的所有订购数据
			*/
			if(0 == $identity || "0" == $identity){
				$type = $_GET['type'];
				if("one" == $type){
					//获取一对一的课程
					// $result = $ocBS->getClass($_SESSION['ID'],0);
					// $this->assign("classdata",$result);
					// $this->display("Student:MySchedule");

					$result = $ocBS->getClass($_SESSION['ID'],0);
					$time = $this->systemSet;
					$time['nowtime'] = getTime();
					$this->assign("time",$time);
					$this->assign("classdata",$result);
					$this->display("Student:MySchedule");
				}elseif("group" == $type){
					//获取小班课的课程
					$result = $ocBS->getClass($_SESSION['ID'],1);
					$this->assign("classdata",$result);
					$this->display("Student:GroupClassSchedule");
				}else{
					$this->error("没有指定操作");
				}
			}elseif(2 == $identity || "2" == $identity){
				//获取学生订购的一对一课程数据
				$studentID = $_GET['user_id'];
				$result = $ocBS->manageGetStudentOrderClass($studentID);

				$this->assign('studentID',$studentID);
				$this->assign("classdata",$result);
				//获取学生订购的小班课程数据
				$this->display("Admin:StuPersonalClass");
			}elseif(4 == $identity || "4" == $identity){
				//获取学生订购的一对一课程数据
				$studentID = $_GET['user_id'];

				$result = $ocBS->manageGetStudentOrderClass($studentID);

				$this->assign('studentID',$studentID);
				$this->assign("classdata",$result);
				//获取学生订购的小班课程数据
				$this->display("Root:StuPersonalClass");
			}else{
				$this->error("你没有权限查看学生的课表");
				return;
			}
		}

		/*
		*俞鹏泽
		*订购一对一课程(包括课程顾问,学生,root)
		*/
		public function studentOneOrderClass(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];
			if("0" == $identity || 0 == $identity){
				//进行学生订课数据的处理
				// exit;
				$data = $_POST['id_data'];
				$studentID = $_SESSION['ID'];
				import("Home.Action.OrderClass.OrderClassBasicService");
				$orderclassOp = new OrderClassBasicService();
				$result = $orderclassOp->OrderOneToOneClass($studentID,$data);
				if($result['status']){
					echo "课程订购成功";
					return;
				}else{
					echo "课程订购失败";
					return;
				}
			}elseif("2" == $identity || 2 == $identity){
				$data = $_POST['id_data'];
				$studentID = $_GET['user_id'];
				import("Home.Action.OrderClass.OrderClassBasicService");
				$orderclassOp = new OrderClassBasicService();
				$result = $orderclassOp->OrderOneToOneClass($studentID,$data);
				if($result['status']){
					echo "课程订购成功";
					return;
				}else{
					echo "课程订购失败";
					return;
				}
			}elseif("4" == $identity || 4 == $identity){
				$data = $_POST['id_data'];
				$studentID = $_GET['user_id'];
				import("Home.Action.OrderClass.OrderClassBasicService");
				$orderclassOp = new OrderClassBasicService();
				$result = $orderclassOp->OrderOneToOneClass($studentID,$data);
				if($result['status']){
					echo "课程订购成功";
					return;
				}else{
					echo "课程订购失败";
					return;
				}
			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}

		/*
		*俞鹏泽
		对学生订课数据进行管理
		*/
		public function studentOrderClassManage(){
			$this->CheckSession();

			import("Home.Action.OrderClass.OrderClassBasicOperate");
			$identity = $_SESSION['identity'];

			$orderClassOp = new OrderClassBasicOperate();
			$type = $_GET['type'];

			if("0" == $identity || 0 == $identity){
				$studentID = $_SESSION['ID'];
				$classType = $_GET['classType'];
				$orderclassID = $_GET['orderclassID'];
				$classID = $_GET['classID'];
				if("classcancel" == $type){
					//获取学生科退课的次数
					import("Home.Action.User.UserBasicOperate");
					$userOp = new UserBasicOperate();
					$cannum = $userOp->getUserInfo('student',$studentID,null,null,null,array('student_cancel_number'));
					if($cannum[0]['student_cancel_number']>0){
						//开启事务
						$inquiry = new Model();
						$inquiry->startTrans();
						if("one" == $classType){
						//退课操作(仅针对一对一退课)
							import("Home.Action.OrderClass.OrderClassBasicService");
							$orderClassSerOp = new OrderClassBasicService();
							$result = $orderClassSerOp->studentOrderClassCancel($orderclassID);
						}else{
							//小班课退课操作(未完成)
						}
						//退课结果处理
						if($result['status']){
							//退课成功减退课次数和回退课程
							$cannum['student_cancel_number'] = $cannum[0]['student_cancel_number'] -1;
							$updateresult = $userOp->updateUserInfo($studentID,null,$cannum);
							import("Home.Action.Class.ClassBasicOperate");
							$classOp = new ClassBasicOperate();
							$classresult = $classOp->updateClassInfo($classID,array('isSelected'=>0));
							if($updateresult['status']&&$classresult['status']){
								//提交事务
								$inquiry->commit();
								$this->success("学生退课成功");
							}
							else{
								$inquiry->rollback();
								$this->error("学生退课失败,请重试");
							}
						}else{
							$inquiry->rollback();
							$this->error("学生退课失败,请重试");
						}
					}else{
						$this->error("您的退课次数不足，无法退课");
					}
				}
				return;
			}elseif("2" == $identity || 2 == $identity){
				if("cgestatus" == $type){  //修改课程状态
						$orderClassID = $_POST['orderclassID'];
						$classtype = $_GET['classtype'];
						$data['classStatus'] = (int)$_POST['classStatus'];
					if("one" == $classtype){   //修改一对一课程的课程状态
						$result = $orderClassOp->updateOneOrderClassInfo($orderClassID,$data);
						if($result['status']){
							$this->success("修改订购一对一课程成功");
						}else{
							$this->error("修改订购一对一课程失败");
						}
					}else{
						//修改小班课程的课程状态  //暂时不完成
					}
					return;
				}elseif("stuorderclasscancel" == $type){   //root帮学生退课
					$oneOrderClassID = $_GET['ID'];
					$token = $_GET['token'];
					$studentID = $_GET['student'];
					if(md5($oneOrderClassID) != $token){
						$this->error("操作失败,请重试");
						return;
					}
					import("Home.Action.OrderClass.OrderClassBasicService");
					$orderClassSerOp = new OrderClassBasicService();
					$result = $orderClassSerOp->studentOrderClassCancel($oneOrderClassID);
					if($result['status']){
						$this->success("学生退课成功");
					}else{
						$this->error("学生退课失败,请重试");
					}
					return;
				}elseif("teaorderclasscancel" == $type){
					$oneOrderClassID = $_GET['ID'];
					$token = $_GET['token'];
					$studentID = $_GET['student'];
					if(md5($oneOrderClassID) != $token){
						$this->error("操作失败,请重试");
						return;
					}
					import("Home.Action.OrderClass.OrderClassBasicService");
					$orderClassSerOp = new OrderClassBasicService();
					$result = $orderClassSerOp->teacherOrderClassCancel($oneOrderClassID);
					if($result['status']){
						$this->success("教师退课成功");
					}else{
						$this->error("教师退课失败,请重试");
					}
					return;
				}else{
					$this->error("没有对应的操作");
					return;
				}
			}elseif("4" == $identity || 4 == $identity){
				if("cgestatus" == $type){  //修改课程状态
					$orderClassID = $_POST['orderclassID'];
					$classtype = $_GET['classtype'];
					$data['classStatus'] = (int)$_POST['classStatus'];
					if("one" == $classtype){   //修改一对一课程的课程状态
						$result = $orderClassOp->updateOneOrderClassInfo($orderClassID,$data);
						if($result['status']){
							$this->success("修改订购一对一课程成功");
						}else{
							$this->error("修改订购一对一课程失败");
						}
					}else{
						//修改小班课程的课程状态  //暂时不完成
					}
					return;
				}elseif("stuorderclasscancel" == $type){   //root帮学生退课
					$oneOrderClassID = $_GET['ID'];
					$token = $_GET['token'];
					$studentID = $_GET['student'];
					if(md5($oneOrderClassID) != $token){
						$this->error("操作失败,请重试");
						return;
					}
					import("Home.Action.OrderClass.OrderClassBasicService");
					$orderClassSerOp = new OrderClassBasicService();
					$result = $orderClassSerOp->studentOrderClassCancel($oneOrderClassID);
					if($result['status']){
						$this->success("学生退课成功");
					}else{
						$this->error("学生退课失败,请重试");
					}
					return;
				}elseif("teaorderclasscancel" == $type){
					$oneOrderClassID = $_GET['ID'];
					$token = $_GET['token'];
					$studentID = $_GET['student'];
					if(md5($oneOrderClassID) != $token){
						$this->error("操作失败,请重试");
						return;
					}
					import("Home.Action.OrderClass.OrderClassBasicService");
					$orderClassSerOp = new OrderClassBasicService();
					$result = $orderClassSerOp->teacherOrderClassCancel($oneOrderClassID);
					if($result['status']){
						$this->success("教师退课成功");
					}else{
						$this->error("教师退课失败,请重试");
					}
					return;
				}else{
					$this->error("没有对应的操作");
					return;
				}
			}else{
				$this->error("你没有权限进行管理操作");
			}
		}

		/*
		*俞鹏泽
		*学生进行上课操作
		*/
		public function studentAttendClass(){
			$this->CheckSession();

			$identity = $_SESSION['identity'];

			import("Home.Action.OrderClass.OrderClassBasicService");
			$ordSerOp = new OrderClassBasicService();
			if("0" == $identity || 0 == $identity){
				//判断学生是否签过相应套餐的合同
				$studentID = $_SESSION['ID'];
				$orderClassID = $_GET['ID'];
				$classType = $_GET['classtype'];

				$result = $ordSerOp->studentAttendClassService($studentID,$orderClassID,$classType);

				if(!$result['status'] && !empty($result['contractInfo'])){
					//表明需要进行合同的签订
					$contractInfo = $result['contractInfo'];
					$contractInfo['startTime'] = getTime();
					$contractInfo['nowTime'] = getTime();

					$this->assign("orderClassID",$orderClassID);
					$this->assign("contract_data",$contractInfo);
					$this->assign("classType",$classType);
					$this->assign("onlyreadflag",false);
					$this->display("Student:Contract");
					return;
				}elseif(!result['status'] && empty($result['contractInfo'])){
					$this->error("发生错误,请联系课程顾问");
					return;
				}else{
					;
				}
			}else{
				$this->error("你没有权限进行操作");
				return;
			}
		}
	}
 ?>
