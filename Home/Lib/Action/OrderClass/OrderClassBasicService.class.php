<?php
	class OrderClassBasicService extends Action{
		private $systemSet = null;
		public function __construct(){
            //获取系统设置
            $field = array();
            import("Home.Action.System.SystemBasicOperate");
			$sysOp = new SystemBasicOperate();
            $result = $sysOp->getSystemSet();
			$this->systemSet = $result;
        }
		/*
		*俞鹏泽
		*订购一对一的课程数据
		*/
		public function OrderOneToOneClass($studentID = null,$data = null){
			$message = array();
			if(is_null($studentID) || is_null($data)){
				$message['status'] = false;
				$message['message'] = "必要的信息没有指定";
				return $message;
			}

			//对获取到的数据先进行处理
			import("Home.Action.OrderClass.OrderClassFeatureService");
			$dealOrderclassResult = OrderClassFeatureService::dealOrderClassData($data);
			/*
			这里如果有必要还可以进行每个套餐的剩余可订购的课程数和现有的要处理的课程数量的比较
			防止课程的多订

			现在这里没有进行处理
			*/
			//对每条数据进行判断,在做处理
			/*需要注意的:
			1.如果当前的订课时间在课程需要发邮件提醒老师有学生订购了课程时间段内则需要发邮件提醒教师
			2.如果选课中的某节课已经被选了就不能继续选择了,需要进行数据回滚
			*/
			$inquiry = new Model();
			$inquiry->startTrans();
			import("Home.Action.User.UserBasicOperate");
			import("Home.Action.Class.ClassBasicOperate");
			import("Home.Action.Mail.MailTo");  //导入发送邮件模块
			import("Home.Action.OrderClass.OrderClassFeatureService");
			import("Home.Action.OrderClass.OrderClassBasicOperate");
			$userOp = new UserBasicOperate();
			$classOp = new ClassBasicOperate();
			$orderClassOp = new OrderClassBasicOperate();

			$studentInfo = $userOp->getUserInfo("student",$studentID,null,null,null,"chinesename,englishname,email");
			foreach ($dealOrderclassResult as $key => $value) {
				foreach ($value as $c_key => $c_value) {
					//获取当前某节课的一些信息
					$classResult = $classOp->getClassInfo($c_value,"classStartTime,isSelected");
					if("1" == $classResult[0]['isSelected'] || 1 == $classResult[0]['isSelected']){
						$inquiry->rollback();
						$message['status'] = false;
						$message['message'] = "订购的课程中有一节课已经被他人订购了";
						return $message;
					}
					//判断现在时间是否在要发邮件的时间段之内,如果是就需要发邮件进行提醒
					$nowTime = getTime();
					$headTime = (int)$classResult[0]['classStartTime']-(int)$this->systemSet['classRemindTime'];
					$taiTime = (int)$classResult[0]['classStartTime']-(int)$this->systemSet['appointCourseDeadline'];
					if($headTime < (int)$nowTime && (int)$nowTime <= $taiTime){
						$txt = "";
						$txt = "在".date('Y-m-d H:i:s').",中文名为{$studentInfo[0]['chinesename']},
						英文名为{$studentInfo[0]['englishname']}的学生订购了你在".
						date("Y-m-d H:i:s",$classResult[0]['classStartTime'])."的课程";
						//这里不做邮件是否发送成功的判断
						MailTo::PostMail($studentInfo[0]['email'],"学生订课提醒",$txt);
					}

					//将要选择的时间的课程设置为选择状态,
					$classdata = array();
					$classdata['isSelected'] = 1;
					$updateClassResult = $classOp->updateClassInfo($c_value,$classdata);
					if(!$updateClassResult['status']){
						$inquiry->rollback();
						$message['status'] = false;
						$message['message'] = "订购的课程失败";
						return $message;
					}

					$orderClassData = array();
					$orderClassData = OrderClassFeatureService::createOrderClassData($studentID,$c_value,$key);
					//将课程的数据写入到数据库中,中途如果发生意外就需要进行回滚并进行错误数据的返回
					$orderClassEndResult = $orderClassOp->addOneOrderClassData($orderClassData);

					if(!$orderClassEndResult['status']){
						$inquiry->rollback();
						$message['status'] = false;
						$message['message'] = "订购的课程失败";
						return $message;
					}
				}
			}

			//跳出循环表示所有的课程订购成功
			$inquiry->commit();
			$message['status'] = true;
			$message['message'] = "订购的课程成功";
			return $message;
		}

		/*
		*俞鹏泽
		*该服务为学生订课前的学生条件的过滤
		*/
		public function studentOrderClassFilterService($studentID = null){
			$message = array();
			if(is_null($studentID)){
				$message['status'] = false;
				$message['message'] = "查询出错";
				return $message;
			}

			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			$orderPackageOp = new OrderPackageBasicOperate();
			/*要判断条件:
			1.学生是否有一对一的套餐
			2.学生是否停过课
			3.学生的一对一套餐是否已经指定了教材
			*/
			$studentID = $_SESSION['ID'];
			//1.判断是否有一对一的套餐
			$orderpackagesql = "select count(*) as oneOrderPackage from tp_orderpackage where
			 isdelete=0 and status=1 and classType=0 and studentID={$studentID}";
			$orderpackageResult = $orderPackageOp->OrderPackageQuery($orderpackagesql);
			if((int)$orderpackageResult[0]['oneOrderPackage'] <= 0){
				$message['status'] = false;
				$message['message'] = "你没有订购一对一套餐,不能进行订课";
				return $message;
			}

			//2.判断学生是否停过课


			//3.判断学生一对一套餐是否已经选择了教材
			$materialsql = "select count(*) as materialResult from tp_orderpackage where
			 isdelete=0 and classType=0 and status=1 and material!=''
			 and studentID={$studentID}";
			$materialResult = $orderPackageOp->OrderPackageQuery($materialsql);
			if((int)$materialResult[0]['materialResult'] > 0){
				$message['status'] = false;
				$message['message'] = "你订购的一对一套餐还没有指定教材,请联系管理员指定教材";
				return $message;
			}

			//跳出前面的操作,表明学生可以进行选课操作
			$message['status'] = true;
			$message['message'] = "可以进行选课操作";
			return $message;
		}

		/*
		*蒋周杰
		*获取学生的一对一
		*/
		public function getClass($studentID = null,$type = null){
			$result = array();
			$inquiry = new Model();
			$time = time();
			if(!is_null($studentID)){
				if(0 == $type){
					//一对一
					$result = $inquiry
					->table('tp_class,tp_oneorderclass,tp_orderpackage,tp_teacher')
					->where("tp_oneorderclass.studentID = {$studentID} and
					tp_oneorderclass.classID = tp_class.classID and
					tp_oneorderclass.orderpackageID = tp_orderpackage.orderpackageID
					 and tp_class.teacherID = tp_teacher.ID and
					 tp_oneorderclass.isdelete = 0  and tp_oneorderclass.classStatus = 0
					 and tp_class.classEndTime > {$time}")->order("classEndTime asc")->select();
					//  dump($result);
					//  dump($this->systemSet);
					//  exit;

				}elseif(1 == $type){
					//小班课
					//$result = $inquiry->table()->where()->select();
				}
			}
			return $result;
		}
	}
 ?>
