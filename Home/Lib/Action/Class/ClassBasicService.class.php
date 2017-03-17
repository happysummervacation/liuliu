<?php
	class ClassBasicService extends Action{
		private $reClassTime = 1800;  //外教一节课的时间差
		private $chClassTime = 3600;  //中教一节课的时间差

		private $systemSet = null;   //系统的设置

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
		*开发教师的有空时间段
		*/
		//参数一:教师的ID
		//参数二:课程数据
		//插入课程开放ID,其值是课程开放时间+教师ID的MD5加密值
		public function Opencourse($teacherID = null,$classData = null){
			$message = array();
			if(is_null($teacherID) || is_null($classData)){
				$message['status'] = false;
				$message['message'] = "开放课程失败";
				return $message;
			}

			$classPeriod = 0;
			/***************   准备数据     ***********/
			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();
			$field = array();
			array_push($field,"teacher_type");
			$teacherType = $userOp->getUserInfo("register",$teacherID,null,null,null,$field);
			if(empty($teacherType)){
				$message['status'] = false;
				$message['message'] = "开放课程失败";
				return $message;
			}elseif($teacherType[0]['teacher_type'] == 0 ||$teacherType[0]['teacher_type'] == "0"){
				$classPeriod = $this->chClassTime;
			}else{
				$classPeriod = $this->reClassTime;
			}
			/************   ************/

			import("Home.Action.Class.ClassBasicFilter");
			import("Home.Action.Class.ClassBasicOperate");
			//获取转换的之后的时间戳数组
			$dealClassData = ClassBasicFilter::transformTimeStrToTimeStamp($classData);
			//指定要添加的字段名
			$fieldData = array();
			array_push($fieldData,"classID","teacherID","classStartTime","classEndTime","createTime","lastModify");

			$Data = array();
			foreach ($dealClassData as $key => $value) {    //$value的值时间戳的数值
				$tem = array();
				array_push($tem,md5($value.$teacherID),$teacherID,$value,(int)$value+$classPeriod,getTime(),getTime());
				array_push($Data,$tem);
			}

			$inquiry = new Model();
			$inquiry->startTrans();    //开启事务

			$classBasOp = new ClassBasicOperate();
			$result = $classBasOp->batchAddClassInfo($fieldData,$Data);

			if($result['status']){
				$inquiry->commit();
				return $result;
			}else{
				$inquiry->rollback();
				return $result;
			}
		}

		/*
		*俞鹏泽
		*关闭教师的有空时间段
		*/
		//参数一:教师ID
		//参数二:课程的时间数据
		public function DeleteCourse($teacherID = null,$classData = null){
			$message = array();
			if(is_null($teacherID) || is_null($classData)){
				$message['status'] = false;
				$message['message'] = "取消课程失败";
				return $message;
			}

			import("Home.Action.Class.ClassBasicFilter");
			import("Home.Action.Class.ClassBasicOperate");
			//获取转换的之后的时间戳数组
			$dealClassData = ClassBasicFilter::transformTimeStrToTimeStamp($classData);

			$inquiry = new Model("class");
			$inquiry->startTrans();
			foreach ($dealClassData as $key => $value) {
				$result = $inquiry->where("teacherID={$teacherID} and classStartTime={$value} and isSelected=0")
				->delete();
				if(!$result){
					$inquiry->rollback();
					$message['status'] = false;
					$message['message'] = "取消课程失败";
					return $message;
				}
			}

			//跳出循环就表示全部删除成功
			$inquiry->commit();
			$message['status'] = true;
			$message['message'] = "取消课程成功";
			return $message;
		}

		/*
		*俞鹏泽
		*查询教师的还没有过期的课程数据
		*/
		//这里暂时只是参看教师还没有过期,也没有过期的空余课程时间
		//在指定选课时间之内的课程不能再被订课了   计算方式是:当先时间+指定时间段 < 课程时间
		public function getTeacherFreeClassTime($teacherID = null){
			if(is_null($teacherID)){
				return null;
			}
			$nowTime = getTime();
			$selectTime = (int)$nowTime+(int)$this->systemSet['appointCourseDeadline'];

			$sql = "";
			$sql = $sql."{$selectTime}<classStartTime and isSelected=0 and isdelete=0";
			import("Home.Action.Class.ClassBasicOperate");
			$classOp = new ClassBasicOperate();

			$field = 'classID,FROM_UNIXTIME(classStartTime,"%Y-%m-%d %H:%i:%S") as "start_time",
			case when classType=0 then "正常课程"
			when classType=1 then "试听课"
			when classType=2 then "一对多" end "class_type"';

			$classInfoResult = $classOp->getoneTeacherClassInfo($teacherID,$field,$sql);

			return $classInfoResult;
		}

		/*
		*俞鹏泽
		*获取指定教师的课程以及课程状态(暂时完成一对一的课程)
		*/
		public function getTeacherClassStatus($teacherID = null,$startTime = null,$endTime = null){
			if(is_null($teacherID)){
				return "{}";
			}

			$inquiry = new Model();
			//先获取指定教师开放的的所有课程时间
			// import("Home.Action.Class.ClassBasicOperate");
			// $claBasOp = new ClassBasicOperate();
			// $openClassResult = $claBasOp->getoneTeacherClassInfo($teacherID,null,"isdelete=0");
			$sql = "select * from tp_class where teacherID={$teacherID} and isdelete=0 and
			classStartTime>={$startTime} and classEndTime<={$endTime}";
			$openClassResult = $inquiry->query($sql);
			//获取指定教师的订购一对一课程数据

			$sql = "select * from tp_oneorderclass
			inner join tp_class on tp_class.classID=
			tp_oneorderclass.classID and tp_oneorderclass.isdelete=0 and
			tp_class.classStartTime>={$startTime} and tp_class.classEndTime<={$endTime}
			and tp_class.teacherID={$teacherID}
			inner join tp_student on tp_student.ID=tp_oneorderclass.studentID";
			$orderClassResult = $inquiry->query($sql);

			//获取指定教师的小班的课程数据
			$gsql  ="select * from tp_groupclasssch
			inner join tp_class on tp_class.classID=tp_groupclasssch.classID and tp_groupclasssch.
			isdelete=0 and tp_class.teacherID={$teacherID} and tp_groupclasssch.gclassStatus!=2
			and tp_class.classStartTime>={$startTime} and tp_class.classEndTime<={$endTime};
			";
			$groupClassResult = $inquiry->query($gsql);

			foreach ($groupClassResult as $key => $value) {
				$temsql = "select tp_student.account from tp_groupstuclasssch inner join tp_groupclasssch on
				tp_groupclasssch.groupClassSchID=tp_groupstuclasssch.groupClassSchID and
				tp_groupstuclasssch.groupClassSchID={$value['groupClassSchID']} and
				tp_groupstuclasssch.isdelete=0
				inner join tp_student on tp_student.ID=tp_groupstuclasssch.studentID";
				$temresult = $inquiry->query($temsql);
				$groupClassResult[$key]['student'] = $temresult;
			}

			//获取当前时间
			$nowTime = getTime();
			import("Home.Action.Class.ClassBasicFilter");
			$dealResult = ClassBasicFilter::getClassStatusWithCondition($openClassResult,$orderClassResult,$groupClassResult);

			if(is_null($dealResult)){
				return "{}";
			}else{
				return $dealResult;
			}
		}

		/*
		*俞鹏泽
		*根据前端传输的数据来获取当前该时间的课学生的信息
		*/
		//参数一:教师的ID
		//参数二:课程的开始时间
		//流程:
		//1.先根据教师来获取教师的类型,同时获取该节课的开始时间和结束时间   (这一步不需要)
		//2.根据课程的开始结束时间获取课程tp_class中的数据.判断是小班还是一对一课程
		//3.获取必要的数据

		//小班的课程数据暂时没有写
		public function getClassInfoService($teacherID = null,$time = null){
			if(is_null($teacherID) || is_null($time)){
				return null;
			}

			// import("Home.Action.User.UserBasicOperate");
			import("Home.Action.Class.ClassBasicOperate");
			// $userOp = new UserBasicOperate();
			$classOp = new ClassBasicOperate();

			// $userResult = $userOp->getUserInfo('teacher',$teacherID,null,null,null,"teacher_type")[0]['teacher_type'];
			// $classStartTime = $time;
			// $classEndTime = 0;
			// if(0 == $userResult){
			// 	$classEndTime = $classStartTime+$this->chClassTime;
			// }elseif(1 == $userResult){
			// 	$classEndTime = $classStartTime+$this->reClassTime;
			// }
			//根据时间以及教师ID来获取classID
			$classID = MD5($time.$teacherID);
			$classType = $classOp->getClassInfo($classID,'classType')[0]['classType'];
			$inquiry = "";
			if(0 == (int)$classType){
				$inquiry = new Model("oneorderclass");
				$result = $inquiry
				->join("inner join tp_class on tp_class.classID=tp_oneorderclass.classID and
				tp_class.classID='{$classID}' and (tp_oneorderclass.classStatus!=2)
				inner join tp_student on tp_student.ID=tp_oneorderclass.studentID
				inner join tp_orderpackage on tp_orderpackage.orderpackageID=tp_oneorderclass.orderpackageID
				inner join tp_packageconfig on tp_packageconfig.packageconID=tp_orderpackage.category")
				->field("tp_student.account,tp_student.phone,tp_student.ID,tp_class.remark,
				tp_orderpackage.material,tp_class.classID,tp_packageconfig.packageName")
				->select();

				//做一下数据处理
				$result = $result[0];
				return $result;
			}elseif(1 == (int)$classType){
				$inquiry = new Model("groupclasssch");
				//先获取小班的班级数据
				//在获取每个班级中的学生的上课数据
				$gsql  ="select tp_class.classID,tp_packageconfig.packageName,tp_group.material,
				tp_class.remark,tp_groupclasssch.groupClassSchID
				from tp_groupclasssch
				inner join tp_class on tp_class.classID=tp_groupclasssch.classID and tp_groupclasssch.
				isdelete=0 and tp_class.teacherID={$teacherID} and tp_groupclasssch.gclassStatus!=2
				and tp_class.classID='{$classID}'
				inner join tp_group on tp_group.groupID=tp_groupclasssch.groupID
				inner join tp_packageconfig on tp_packageconfig.packageconID=tp_group.gcategory;
				";
				$groupClassResult = $inquiry->query($gsql);

				foreach ($groupClassResult as $key => $value) {
					$temsql = "select tp_student.account,tp_student.phone from tp_groupstuclasssch inner join tp_groupclasssch on
					tp_groupclasssch.groupClassSchID=tp_groupstuclasssch.groupClassSchID and
					tp_groupstuclasssch.groupClassSchID={$value['groupClassSchID']} and
					tp_groupstuclasssch.isdelete=0
					inner join tp_student on tp_student.ID=tp_groupstuclasssch.studentID";
					$temresult = $inquiry->query($temsql);
					$groupClassResult[$key]['student'] = $temresult;
				}
				//进行数据处理
				foreach ($groupClassResult as $key => $value) {
					$temstu = "";
					$temphone = "";
					foreach ($value['student'] as $t_key => $t_value) {
						$temstu .= $temstu.$t_value['account'].":";
						$temphone .= $t_temphone.$t_value['phone'].":";
					}
					$groupClassResult[$key]['phone'] = $temphone;
					$groupClassResult[$key]['student'] = $temstu;
				}
				return $groupClassResult[0];
			}elseif(2 == (int)$classType){

			}


		}
	}
 ?>
