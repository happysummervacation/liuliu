<?php
	/*
	*俞鹏泽
	*该类专门用来处理学生小班课表相关操作
	*/
	class GroupStuClassSchBasicService extends Action{
		/*
		*俞鹏泽
		*添加学生的小班课表
		*/
		//参数一:学生的ID
		//参数二:班级课表的ID
		public function addGroupStuClassInfo($studentID = null,$groupClassSchID = null){
			$message = array();
			if(is_null($studentID) || is_null($groupClassSchID)){
				$message['status'] = false;
				$message['message'] = "添加学生课表数据时缺乏必要的数据,添加学生课表数据失败";
				return $message;
			}

			$inquiry = new Model("groupstuclasssch");
			$data = array();
			$data['groupClassSchID'] = $groupClassSchID;
			$data['studentID'] = $studentID;
			$data['createTime'] = getTime();
			$result = $inquiry->add($data);
			if($result){
				$message['status'] = true;
				$message['message'] = "添加学生的课表数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加学生的课表数据失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*删除某个学生在某个小班的一节课程(这里的删除一节课就是在逻辑上就是删除一条数据)
		*/
		public function deleteStuGroupClass($studentID = null,$groupID = null){
			$message = array();
			if(is_null($studentID) || is_null($groupID)){
				$message['status'] = false;
				$message['message'] = "缺乏更新时的数据";
				return $message;
			}

			$inquiry = new Model("groupstuclasssch");

			$data['tp_groupstuclasssch.isdelete'] = 1;

			$result = $inquiry->join("inner join tp_groupclasssch on tp_groupclasssch.groupClassSchID=
			tp_groupstuclasssch.groupStuClassSchID and tp_groupstuclasssch.studentID={$studentID}
			inner join tp_group on tp_group.groupID=tp_groupclasssch.groupID and tp_groupclasssch.
			groupID={$groupID}")->save($data);
			if($result){
				$message['status'] = true;
				$message['message'] = "更新学生的小班数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "更新学生的小班数据失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*获取某个学生上某个班时,各种状态的课程数据
		*/
		//参数一:学生的ID,[用来表示是哪个学生]
		//参数二:班级ID,[用来表示是上哪个班级]
		//参数三:教师的ID,[用来表示是哪个教师]
		//参数四:表示课程的状态,[如果为null,表示不管课程的状态]   多种状态使用****:****:****进行数据获取
		//参数五:要查询的字段,
		//参数六:表示开始时间段(时间戳)  如果时间为null表示整个小班期间的数据
		//参数七:表示结束时间段

		//该函数还没有测试过正确性
		public function getGroupStuClassInfo($studentID = null,$groupID = null,$teacherID = null,
		$classStatus = null,$field = null,$startTime = null,$endTime = null){
			if(is_null($studentID) || is_null($groupID)){
				return null;
			}
			$fieldString = transformFieldToFieldString($field);  //要查询的字段信息

			$statusString = "( 1=2 ";  //获取课程状态的数据条件
			$statusResult = explode(":",$classStatus);
			import("Home.Action.GlobalValue.GlobalValue");
			//将课程的状态信息进行获取
			foreach ($statusResult as $key => $value) {
				if($value == GlobalValue::notClass){
					$statusString = $statusString." or gclassStatus=0 ";
				}elseif($value == GlobalValue::haveClass){
					$statusString = $statusString." or gclassStatus=1 ";
				}
			}
			$statusString = $statusString.")";

			$timeCondition = " 1=1 ";   //这是时间的条件
			if(!is_null($startTime) && !is_null($endTime)){
				$timeCondition = $timeCondition."tp_class.classStartTime>={$startTime} and tp_class.
				classEndTime<={$endTime}";
			}

			$teaCondition = " 1=1 ";    //表示教师的条件
			if(!is_null($teacherID)){
				$teaCondition = "tp_class.teacherID={$teacherID}";
			}

			$inquiry = new Model("groupstuclasssch");

			/*
			*该查询联查了  tp_groupclasssch,tp_groupstuclasssch,tp_class,tp_teacher四张表
			*/
			$result = $inquiry->join("inner join tp_groupclasssch on tp_groupclasssch.groupClassSchID=
			tp_groupstuclasssch.groupClassSchID and isdelete=0 and {$statusString}")
			->join("inner join tp_class on tp_class.classID=tp_groupclasssch.classID and {$teaCondition}
			 and {$timeCondition}")
			->join("inner join tp_teacher on tp_class.teacherID=tp_teacher.ID")
			->select();

			return $result;
		}
	}
