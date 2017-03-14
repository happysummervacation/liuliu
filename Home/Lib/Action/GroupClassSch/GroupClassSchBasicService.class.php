<?php
	/*
	*俞鹏泽
	*该类主要是用来处理与班级课程相关的数据
	*/
	class GroupClassSchBasicService extends Action{
		/*
		*俞鹏泽
		*该函数用来为某个小班课添加某个小班课程课程
		*/
		//参数一:表示小班的ID     只能是单个数据操作
		//参数二:表示要添加的小班的某个教师的时间段ID     只能是单个数据操作
		public function addOneGroupClassInfo($groupID = null,$classID = null){
			$message = array();
			if(is_null($groupID) || is_null($classID)){
				$message['status'] = false;
				$message['message'] = "缺乏生成小班班级课表的必要数据,添加小班班级课表失败";
				return $message;
			}

			$data = array();
			$data['groupID'] = $groupID;
			$data['classID'] = $classID;
			$data['createTime'] = getTime();

			$inquiry = new Model("groupclasssch");
			$result = $inquiry->add($data);

			if($result){
				$message['status'] = true;
				$message['message'] = "添加小班课程表数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加小班课程表数据失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*根据各种条件查询某个小班的课程信息
		*/
		//参数一:表示小班
		//参数二:表示是哪个教师
		//参数三:要查询的数据字段  支持数据,字符串,null(其中直接包含评论的数据,所以查询时不用包含评论的数据)
		//参数四:开始时间(时间戳)   这里的时间指的是课程开始时间以及结束时间
		//参数五:结束时间
		public function getOneGroupClassSchInfo($groupID = null,$teacherID = null,$field = null,
		$startTime = null,$endTime = null){
			if(is_null($groupID)){
				return null;
			}
			$fieldString = "";
			$fieldString = transformFieldToFieldString($field);

			$teaCondition = "";
			if(!is_null($teacherID)){
				$teaCondition = " tp_class.teacherID={$teacherID} ";
			}

			$inquiry = new Model();

			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry
				->table("tp_group,tp_groupclasssch,tp_groupteachercom,tp_class,tp_teacher")
				->where("tp_group.groupID=tp_groupclasssch.groupID and tp_groupclasssch.isdelete=0
				and tp_class.classID=tp_groupclasssch.classID and tp_class.teacherID=tp_teacher.ID
				and if(tp_groupclasssch.gteacherComment is null,'1=1','tp_groupclasssch.
				gteacherComment=tp_groupteachercom.groupTeacherComID')")
				->field("if(tp_groupclasssch.gteacherComment is null,'','tp_groupteachercom.*,') {$fieldString}")
				->select();
			}else{
				$result = $inquiry
				->table("tp_group,tp_groupclasssch,tp_groupteachercom,tp_class,tp_teacher")
				->where("tp_group.groupID=tp_groupclasssch.groupID and tp_groupclasssch.isdelete=0
				and tp_class.classID=tp_groupclasssch.classID and tp_class.teacherID=tp_teacher.ID
				and tp_class.classStartTime>={$startTime} and tp_class.classEndTime<={$endTime}
				and if(tp_groupclasssch.gteacherComment is null,'1=1','tp_groupclasssch.
				gteacherComment=tp_groupteachercom.groupTeacherComID')")
				->field("if(tp_groupclasssch.gteacherComment is null,'','tp_groupteachercom.*,') {$fieldString}")
				->select();
			}

			return $result;
		}

		/*
		*俞鹏泽
		*该函数主要用来更新小班的课程数据
		*/
		//参数一:表示小班课程数据的ID
		//参数二:表示要更新的小班的课程数据
		public function updateOneGroupClassSchInfo($groupClassSchID = null,$Data = null){
			$message = array();
			if(is_null($groupClassSchID) || is_null($Data)){
				$message['status'] = false;
				$message['message'] = "缺乏更新的重要数据";
				return $message;
			}

			$inquiry = new Model("groupclasssch");
			$result = $inquiry->where("groupClassSchID={$groupClassSchID}")->save($Data);
			if($result || 0 == $result){
				$message['status'] = true;
				$message['message'] = "更新小班课程数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "更新小班课程数据失败";
				return $message;
			}
		}

		/*
		蒋周杰
		给老师添加一节小班的上课时间
		参数一：教师的ID
		参数二：要开放的时间
		*/
		public function addGroupClass($teacherID = null,$date = null){
			$inquiry = new Model();
			$message = array();
			if(is_null($teacherID) || is_null($date)){
				$message['status'] = false;
				$message['message'] = "开放课程失败";
				return $message;
			}
			$Data = array();
			//获取一节课的持续时间，中教一小时，外教半小时
			$classPeriod = 0;
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


			//添加数据
			$Data['classStartTime'] = "";
			$Data['classStartTime'] = strtotime("{$date['year']}-{$date['date']} {$date['time']}");
			$Data['classEndTime'] = (int)$Data['classStartTime']+$classPeriod;
			$Data['classID'] = md5($Data['classStartTime'].$teacherID);
			$Data['teacherID'] = $teacherID;
			$Data['createTime'] = getTime();
			$Data['lastModify'] = getTime();
			$Data['isSelected'] = 1;
			$Data['classType'] = 1;

			$inquiry = new Model("class");
			$result = $inquiry->add($Data);
			if($result){
                $message['status'] = true;
                $message['message'] = "用户数据增添成功";
                return $message;
            }else{
                $message['status'] = false;
                $message['message'] = "用户数据增添失败";
                return $message;
            }
		}

	}
