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
			//获取各类套餐订购的课时数据是哪些
			$dealOrderclassResult = OrderClassFeatureService::dealOrderClassData($data);
			//对获取到的课程数据进行时间上的筛选
			/*主要是:
			*1.卡类套餐同一天的过滤
			*2.所有要订购的课程时间与已经订购的课程数据时间的同一时间交集的过滤
			*/
			//判断使用的套餐是否使用了卡类的套餐,如果有使用卡类套餐就进行同一时间段的判断
			$orderClassTimeArr = array();
			import("Home.Action.OrderClass.OrderClassFeatureService");
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			import("Home.Action.Class.ClassBasicOperate");
			import("Home.Action.OrderClass.stuOrderClassService");
			import("Home.Action.GlobalValue.GlobalValue");

			$stuOrdClassOp = new stuOrderClassService();
			$ordPacOp = new OrderPackageBasicOperate();
			$classOp = new ClassBasicOperate();
			foreach ($dealOrderclassResult as $key => $value) {
				$temPacInfo = $ordPacOp->getOneOrderPackageInfo($key,"packageType");
				//如果是卡类套餐,还要获取使用该卡类套餐订购的未上课程的时间
				if(1 == $temPacInfo[0]['packageType'] || "1" == $temPacInfo[0]['packageType']){
					$temDealArr = array();
					foreach ($value as $t_key => $t_value) {
						$temresult = 0;
						$temresult = $classOp->getClassInfo($t_value,"tp_class.classStartTime")[0];
						array_push($temDealArr,$temresult);
					}

					$temDealArray = $stuOrdClassOp->getStudentOneOrderClassWithStatus($studentID,GlobalValue::notClass,$key,"tp_class.classStartTime");
					if(!empty($temDealArray)){
						foreach ($temDealArray as $key => $value) {
							array_push($temDealArr,$value);
						}
					}

					if(!OrderClassFeatureService::JudgeSameDay($temDealArr)){
						$message['status'] = false;
						$message['message'] = "卡类套餐有同一天的时间";
						return $message;
					}
				}
				//获取所有提交上来的课程的开始时间与结束时间,在下面有使用
				foreach ($value as $t_key => $t_value) {
					$temresult = 0;
					$temresult = $classOp->getClassInfo($t_value,"tp_class.classStartTime,tp_class.classEndTime")[0];
					array_push($orderClassTimeArr,$temresult);
				}
			}

			//获取所有未上课的数据用来判断是否有重叠的时间段课程
			import("Home.Action.OrderClass.stuOrderClassService");
			import("Home.Action.GlobalValue.GlobalValue");
			$stuOrdClassOp = new stuOrderClassService();
			$notClassResult = $stuOrdClassOp->getStudentOneOrderClassWithStatus($studentID,GlobalValue::notClass,
				null,"tp_class.classStartTime,tp_class.classEndTime");

			//判断有预定的课程的数据与未上的课程的数据是否有时间上的重叠
			$judgeResult = OrderClassFeatureService::JudgeTimes($notClassResult,$orderClassTimeArr);
			if(!$judgeResult){
				$message['status'] = false;
				$message['message'] = "课程中有重复时间段的课程";
				return $message;
			}

/*******************************   上面是对课程的过滤  ************************/
/*******************************   下面是对课程的数据库写入   *************************/
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
			import("Home.Action.StopClass.StopClassBasicService");
			$orderPackageOp = new OrderPackageBasicOperate();
			$stopClassOp = new StopClassBasicService();
			/*要判断条件:
			1.学生是否有一对一的套餐
			2.学生是否停过课
			3.学生的一对一套餐是否已经指定了教材
			*/
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
			$stopClassResult = $stopClassOp->checkAndUpdateStopClassTime($studentID);
			if(!$stopClassResult['status'] || $stopClassResult['isStop']){  //如果操作失败,或者处于停课期限之内就进行提醒
				$message['status'] = false;
				$message['message'] = "你还处于停课期限之内,不能进行订课";
				return $message;
			}

			//3.判断学生一对一套餐是否已经选择了教材
			$materialsql = "select count(*) as materialResult from tp_orderpackage where
			 isdelete=0 and classType=0 and status=1 and material=''
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
		*俞鹏泽
		*根据学生的订购的套餐类型来获取可以给该学生上课的教师
		*/
		public function getTeacherWithStudentOrderPac($studentID = null){
			if(is_null($studentID)){
				return null;
			}
			$inquiry = new Model();
			//要查看教师的一对一工资表中的数据是最新的
			//教师一对一工资表中的课程类型为一对一,课程内容是相同的
			//教师的ID与教师的一对一工资表是相同的
			//教师表中的教师是否是中教与订购教材表中的教师是否是中教需要相同
			$sql = "select distinct ID,englishname,teacher_type,image_path from tp_orderpackage
			 inner join tp_teoneclasssalary on tp_teoneclasssalary.isLastest=1
			 and tp_teoneclasssalary.teacherType=tp_orderpackage.teacherType and
			 tp_orderpackage.category=tp_teoneclasssalary.scategory and tp_orderpackage.studentID={$studentID}
			 and classType=0 and tp_orderpackage.status=1
			 inner join tp_teacher on tp_teacher.teacher_type=tp_orderpackage.teacherNation
			 and tp_teacher.ID=tp_teoneclasssalary.teacherID
			 ";
			 $result = $inquiry->query($sql);

			 return $result;
		}

		/*
		*蒋周杰
		*获取学生的一对一
		*/
		// public function getClass($studentID = null,$type = null){
		// 	$result = array();
		// 	$inquiry = new Model();
		// 	$time = getTime();
		// 	if(!is_null($studentID)){
		// 		if(0 == $type){
		// 			//一对一
		// 			$result = $inquiry
		// 			->table('tp_class,tp_oneorderclass,tp_orderpackage,tp_teacher')
		// 			->where("tp_oneorderclass.studentID = {$studentID} and
		// 			tp_oneorderclass.classID = tp_class.classID and
		// 			tp_oneorderclass.orderpackageID = tp_orderpackage.orderpackageID
		// 			 and tp_class.teacherID = tp_teacher.ID and
		// 			 tp_oneorderclass.isdelete = 0  and tp_oneorderclass.classStatus = 0
		// 			 and tp_class.classEndTime > {$time}")->order("classEndTime asc")->select();
		// 			//  dump($result);
		// 			//  dump($this->systemSet);
		// 			//  exit;
		//
		// 		}elseif(1 == $type){
		// 			//小班课
		// 			//$result = $inquiry->table()->where()->select();
		// 		}
		// 	}
		// 	return $result;
		// }

		/*
		*蒋周杰
		*获取学生的一对一
		*/
		public function getClass($studentID = null,$type = null){
			$result = array();
			$inquiry = new Model();
			$time = getTime();
			if(!is_null($studentID)){
				if(0 == $type){
					//一对一
					$result = $inquiry
					->table('tp_class,tp_oneorderclass,tp_orderpackage,tp_teacher,tp_packageconfig')
					->where("tp_oneorderclass.studentID = {$studentID} and
					tp_oneorderclass.classID = tp_class.classID and
					tp_oneorderclass.orderpackageID = tp_orderpackage.orderpackageID
					 and tp_class.teacherID = tp_teacher.ID and (tp_oneorderclass.classStatus=0 or
					 tp_oneorderclass.classStatus=1) and
					 tp_oneorderclass.isdelete = 0
					 and tp_class.classEndTime > {$time}
					 and tp_orderpackage.category=tp_packageconfig.packageconID")
					 ->field("tp_orderpackage.*,tp_packageconfig.packageName as claName,
					 tp_oneorderclass.*,tp_teacher.*,tp_class.*")
					 ->order("classEndTime asc")->select();
				}elseif(1 == $type){
					//小班课
					$sql="select * from tp_groupstuclasssch
					inner join tp_groupclasssch on tp_groupclasssch.groupClassSchID = tp_groupstuclasssch.groupClassSchID
					inner join tp_group on tp_groupclasssch.groupID = tp_group.groupID
					inner join tp_tegroupclasssalary on tp_group.groupID=tp_tegroupclasssalary.groupID
					inner join tp_teacher on tp_teacher.ID = tp_tegroupclasssalary.teacherID
					inner join tp_class on tp_class.classID = tp_groupclasssch.classID
					where tp_tegroupclasssalary.gIsLastest = 1 and tp_tegroupclasssalary.isdelete = 0 and tp_groupstuclasssch.isdelete = 0 and tp_groupstuclasssch.studentID = 21 and
						tp_class.classEndTime > {$time}";
					$result = $inquiry->query($sql);
				}
			}
			return $result;
		}

		/*
		*俞鹏泽
		*获取学生一对一课程与小班课课程
		*/
		public function manageGetStudentOrderClass($studentID = null){
			if(is_null($studentID)){
				return null;
			}

			$inquiry = new Model("oneorderclass");
			//获一对一的订购课程
			$result = $inquiry->join("inner join tp_orderpackage on tp_orderpackage.orderpackageID=
			tp_oneorderclass.orderpackageID and tp_orderpackage.studentID={$studentID}
			inner join tp_class on tp_class.classID=tp_oneorderclass.classID
			inner join tp_packageconfig on tp_orderpackage.category=tp_packageconfig.packageconID
			")
			->field("tp_oneorderclass.classStatus,tp_orderpackage.material,classStartTime,classEndTime,
			note,tp_packageconfig.packageName,tp_orderpackage.classType,
			teacherNation,teacherType,tp_oneorderclass.oneorderclassID,tp_class.classID,
			tp_oneorderclass.studentID,tp_oneorderclass.orderpackageID")
			->select();

			return $result;
		}

		/*
		蒋周杰
		学生小班上课操作
		*/
		public function StudentAttendGroupClass($studentID = null,$orderClassID = null){
			$message = array();
			if(is_null($studentID) || is_null($orderClassID)){
				$message['status'] = false;
				$message['message'] = "缺失重要的数据";
				return $message;
			}

			//更新两个课程表的课程状态
			$data1['gclassStatus'] = 1;
			$inquiry = new Model();
			$result1 = $inquiry->table('tp_groupclasssch')->where("groupClassSchID = {$orderClassID}")->save($data1);

			$data2['stuClassStatus'] = 1;
			$result2 =$inquiry->table('tp_groupstuclasssch')->where("studentID = {$studentID} and groupClassSchID = {$orderClassID}")->save($data2);
			//获取教师的ZOOM
			$zoom = $inquiry->table('tp_groupclasssch,tp_teacher,tp_tegroupclasssalary')
			->where("tp_groupclasssch.groupClassSchID = {$orderClassID} and tp_tegroupclasssalary.groupID = tp_groupclasssch.groupID and tp_tegroupclasssalary.gIsLastest = 1 and tp_tegroupclasssalary.teacherID = tp_teacher.ID")->field(array('zoom'))
			->select();
			header("location:".$zoom[0]['zoom']);
			$message['status'] = true;
			$message['message'] = "正常上课";
			return $message;
		}


		/*
		*俞鹏泽
		*学生订购的课程进行退课(仅针对一对一课程)
		*/
		//先对课程数据进行状态修改
		//在对指定时间段进行状态修改
		public function studentOrderClassCancel($orderClassID = null){
			$message = array();
			if(is_null($orderClassID)){
				$message['status'] = false;
				$message['message'] = "没有指定要修改的数据";
				return $message;
			}
			$sql = "update tp_oneorderclass,tp_class set `isSelected`=0,`classStatus`=2
			 where tp_oneorderclass.classID=tp_class.classID and classStatus=0 and
			  oneorderClassID={$orderClassID}";

			 $inquiry = new Model();
			 $result = $inquiry->execute($sql);

			 if($result){
				 $message['status'] = true;
				 $message['message'] = "学生退课成功";
				 return $message;
			 }else{
				 $message['status'] = false;
				 $message['message'] = "学生退课失败";
				 return $message;
			 }
		}

		/*
		*俞鹏泽
		*对于学生选择的一对一课程,教师进行退课(仅针对一对一课程)
		*/
		public function teacherOrderClassCancel($orderClassID = null){
			$message = array();
			if(is_null($orderClassID)){
				$message['status'] = false;
				$message['message'] = "没有指定要修改的数据";
				return $message;
			}
			import("Home.Action.OrderClass.OrderClassBasicOperate");
			$ordClassOp = new OrderClassBasicOperate();
			$data['classStatus'] = 6;
			$result = $ordClassOp->updateOneOrderClassInfo($orderClassID,$data);

			 if($result){
				 $message['status'] = true;
				 $message['message'] = "教师退课成功";
				 return $message;
			 }else{
				 $message['status'] = false;
				 $message['message'] = "教师退课失败";
				 return $message;
			 }
		}

		/*
		*俞鹏泽
		*学生进行上课的操作服务
		*/
		//获取指定的订购课程的数据,
		//判断课程对应的套餐的合同是否已经签订,没有签订就进行签订,签订了就直接进行上课
		//并进行处理上课处理
		public function studentAttendClassService($studentID = null,$orderClassID = null,$classType = null){
			$message = array();

			if(is_null($studentID) || is_null($orderClassID) || is_null($classType)){
				$message['status'] = false;
				$message['message'] = "缺失重要的数据";
				return $message;
			}

			if($classType != "onetoone" && $classType != "group"){
				$message['status'] = false;
				$message['message'] = "课程类型有问题";
				return $message;
			}

			$sql = "select
			 isSign,zoom,tp_student.chinesename,tp_student.sex,tp_student.phone,tp_student.country,
			 tp_orderpackage.packageMoney,tp_packageconfig.packageName,tp_orderpackage.classType,
			 tp_orderpackage.packageType,tp_orderpackage.classNumber,tp_orderpackage.teacherNation,
			 tp_orderpackage.teacherType ,tp_orderpackage.time,tp_orderpackage.orderpackageID,ordercontractID
			 from tp_studentcontract
			 inner join tp_orderpackage on tp_orderpackage.orderpackageID=tp_studentcontract.orderpackageID
			 inner join tp_oneorderclass on tp_oneorderclass.orderpackageID=tp_orderpackage.orderpackageID
			 and tp_oneorderclass.oneorderclassID={$orderClassID}
			 inner join tp_class on tp_oneorderclass.classID=tp_class.classID
			 inner join tp_teacher on tp_teacher.ID=tp_class.teacherID
			 inner join tp_student on tp_student.ID=tp_studentcontract.order_party and order_party={$studentID}
			 inner join tp_packageconfig on tp_packageconfig.packageconID=tp_orderpackage.category";

			 $inquiry = new Model();
			 $result = $inquiry->query($sql);

			if("0" == $result[0]['isSign'] || 0 == $result[0]['isSign']){
				//表示没有签订数据
				$message['status'] = false;
				$message['message'] = "还没有签订合同";
				$message['contractInfo'] = $result[0];
				return $message;
			}else{
				//表示签订了合同,进行正常的上课操作
				//先将学生订购的课程的课程状态设置成学生上课的状态
				if("onetoone" == $classType){
					import("Home.Action.OrderClass.OrderClassBasicOperate");
					$orderClaOp = new OrderClassBasicOperate();
					$data['classStatus'] = 1;
					$updateResult = $orderClaOp->updateOneOrderClassInfo($orderClassID,$data);
					//暂时不做课程状态修改成功与否的判断
					// if(!$result['status']){
					//
					// }
				}else{
					//这里进行小班课的上课
				}

				header("location:".$result[0]['zoom']);
				$message['status'] = true;
				$message['message'] = "学生已经签订合同,正常上课";
				return $message;
			}
		}

		/*
		*蒋周杰
		*获取学生已经完成的课程
		*参数一：学生的ID
		*/
		public function getMyFinishedClass($studentID = null){
			if($studentID == null){
				return;
			}
			$inquiry = new Model();
			$result = $inquiry
			->table('tp_class,tp_oneorderclass,tp_teacher')
			->where("tp_class.classID = tp_oneorderclass.classID and
			tp_oneorderclass.studentID = {$studentID} and
			(tp_oneorderclass.classStatus=1 or tp_oneorderclass.classStatus=3 or
			tp_oneorderclass.classStatus=4) and tp_oneorderclass.isdelete=0
			and tp_class.teacherID = tp_teacher.ID")
			->field("tp_teacher.englishname,tp_class.*,tp_oneorderclass.*")
			->select();

			return $result;

		}
	}
 ?>
