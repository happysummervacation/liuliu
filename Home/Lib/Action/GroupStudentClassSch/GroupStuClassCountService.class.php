<?php
	/*
	*俞鹏泽
	*该函数用来统计学生小班课表中的数据
	*/
	class GroupStuClassCountService extends Action{
		/*
		*俞鹏泽
		*该函数用来统计某个学生在某个时间之内已经上过的课程数量
		*/
		//参数一:哪个班级
		//参数二:学生的ID,用来表示是哪个学生
		//参数三:教师的ID,表示该学生在该班级中上的指定该教师的课,如果该参数值为null则表示不用规定教师
		//参数四:表示要统计哪种类型的课程,暂定是上过和没上过两种,后期看情况加减   多种情况时使用****:****:****
		//参数五:表示开始时间(时间戳)
		//参数六:表示结束时间(时间戳)
		//暂时未做测试
		public function countStuGroupClassWithStatus($groupID = null,$studentID = null,$teacherID = null
		,$classStatus = null,$startTime = null,$endTime = null){
			if(is_null($groupID) || is_null($studentID) || is_null($status)){
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
					$statusString = $statusString." or gclassStatus=1 ";
				}
			}

			$teaCondition = "";
			if(!is_null($teacherID)){
				$teaCondition = $teaCondition." tp_class.teacherID={$teacherID} and ";
			}
			$inquiry = new Model("groupstuclasssch");

			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry->join("inner join tp_groupclasssch on tp_groupclasssch.groupClassSchID=
				tp_groupstuclasssch.groupClassSchID and studentID={$studentID} and tp_groupstuclasssch.
				isdelete=0")
				->join("inner join tp_class on tp_classID=tp_groupclasssch.classID and {$teaCondition}")
				->count("{$statusString}");
			}else{
				$result = $inquiry->join("inner join tp_groupclasssch on tp_groupclasssch.groupClassSchID=
				tp_groupstuclasssch.groupClassSchID and studentID={$studentID} and tp_groupstuclasssch.
				isdelete=0")
				->join("inner join tp_class on tp_classID=tp_groupclasssch.classID and {$teaCondition}
				and classStartTime>={$startTime} and classEndTime<={$endTime}")
				->count("{$statusString}");
			}

			return $result;
		}
	}
