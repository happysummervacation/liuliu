<?php
	/*
	*俞鹏泽
	*该类主要用来统计班级课程的各种数据
	*/
	class GroupClassSchCountService extends Action{
		/*
		*俞鹏泽
		*该函数用来统计某个班级某个时间段内已经上过的课程数量
		*/
		//参数一:哪个班级
		//参数二:表示要统计哪种类型的课程,暂定是上过和没上过两种,后期看情况加减,如果要表示多种情况使用 ***:***:***的方式
		//参数三:表示开始时间(时间戳)  如果开始时间与结束时间中有一个是null则统计其整个小班期间的数据
		//参数四:表示结束时间(时间戳)
		//参数五:表示教师的ID,  表示该班级中的课程是该教师上的课的课程数量
		public function countGroupClassWithStatus($groupID = null,$status = null,
			$startTime = null,$endTime = null,$teacherID = null){
			if(is_null($groupID) || is_null($status)){
				return -1;
			}

			$statusString = "null ";
			$statusResult = explode(":",$status);

			import("Home.Action.GlobalValue.GlobalValue");
			//将课程的状态信息进行获取
			foreach ($statusResult as $key => $value) {
				if($value == GlobalValue::notClass){
					$statusString = $statusString." or gclassStatus=0";
				}elseif($value == GlobalValue::haveClass){
					$statusString = $statusString." or gclassStatus=1 or gclassStatus=3 or gclassStatus=4";
				}elseif($value == GlobalValue::teaMissClass){
					$statusString = $statusString." or gclassStatus=5";
				}elseif($value == GlobalValue::teaCancelClass){
					$statusString = $statusString." or gclassStatus=6";
				}
			}

			$teaCondition = "";
			if(!is_null($teacherID)){
				$teaCondition = " and tp_class.teacherID={$teacherID}";
			}

			$inquiry = new Model("groupclasssch");
			if(is_null($startTime) || is_null($endTime)){   //直接进行该班级的所有数据的查找
				$result = $inquiry->join("inner join tp_class on tp_class.classID=tp_groupclasssch.
				classID and groupID={$groupID} and tp_groupclasssch.isdelete=0 {$teaCondition}")
				->count("{$statusString}");
			}else{   //表示在对应时间段之内进行数据查询
				$result = $inquiry->join("inner join tp_class on tp_class.classID=tp_groupclasssch.
				classID and groupID={$groupID} and tp_groupclasssch.isdelete=0 and
				classStartTime>={$startTime} and classEndTime<={$endTime} {$teaCondition}")
				->count("{$statusString}");
			}

			return $result;
		}

		/*
		*俞鹏泽
		*用来统计某个小班某个教师在某段时间内上过的各种情况的课的数量
		*/
		//参数一:小班ID[用来表示是哪个小班]
		//参数二:教师的ID[用来表示哪个教师]
		//参数三:表示时间段的开始时间(时间戳)  如果开始与结束时间有一个是null,则表示统计的是整个小班上课时间内的课程
		//参数四:表示时间段的结束时间(时间戳)
		//参数五:表示小班课程的上课情况   如果要表示多种情况使用 ***:***:***d的形式
		public function countGroupClassWithTeacherStatus($groupID = null,$teacherID = null,
			$classStatus = null,$startTime = null,$endTime = null){
			if(is_null($groupID) || is_null($classStatus) || is_null($teacherID)){
				return -1;
			}

			$statusString = "null ";
			$statusResult = explode(":",$classStatus);
			import("Home.Action.GlobalValue.GlobalValue");
			//将课程的状态信息进行获取
			foreach ($statusResult as $key => $value) {
				if($value == GlobalValue::notClass){
					$statusString = $statusString." or gclassStatus=0 ";
				}elseif($value == GlobalValue::haveClass){
					$statusString = $statusString." or or gclassStatus=1 or gclassStatus=3 or gclassStatus=4 ";
				}elseif($value == GlobalValue::teaMissClass){
					$statusString = $statusString." or gclassStatus=5";
				}elseif($value == GlobalValue::teaCancelClass){
					$statusString = $statusString." or gclassStatus=6";
				}
			}

			$inquiry = new Model("groupclasssch");
			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry
				->join("inner join tp_class on tp_class.classID=tp_groupclasssch.
				classID and groupID={$groupID} and tp_groupclasssch.isdelete=0 and tp_class.teacherID=
				{$teacherID}")
				->count("{$statusString}");
			}else{
				$result = $inquiry->join("inner join tp_class on tp_class.classID=tp_groupclasssch.
				classID and groupID={$groupID} and tp_groupclasssch.isdelete=0 and tp_class.teacherID=
				{$teacherID} and classStartTime>={$startTime} and classEndTime<={$endTime}")
				->count("{$statusString}");
			}

			return $result;
		}

		/*
		蒋周杰
		查询一节未上小班课的学生人数
		参数一：classID
		*/
		public function getclassStudentNum($classID = null){
			if(is_null($classID)){
				return null;
			}

			$inquiry = new Model();
			$sql = "select count(groupClassSchID = {$classID} or null) as num
			from tp_groupstuclasssch where isdelete = 0 and stuClassStatus = 0";
			$result = $inquiry->query($sql);
			return $result[0]['num'];
		}
	}
