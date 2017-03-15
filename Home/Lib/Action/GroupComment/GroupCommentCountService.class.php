<?php
	/*
	*俞鹏泽
	*该函数用来处理小班课评论的统计
	*/
	class GroupCommentCountService extends Action{
		/*
		*俞鹏泽
		*该函数用来统计某个小班的某个教师的评论次数
		*/
		//参数一:某个小班
		//参数二:表示某个教师
		//参数三:表示课程状态   如果是null则默认是正常上课,教师迟到,教师早退  (这里暂时只支持正常上课与没有上课)
		//参数四:表示评论状态   主要根据GlobalValue中的值来进行比较
		//多种评论条件查询时使用***:***:***&***:***:***的方式
		//参数五:表示开始时间(时间戳)
		//参数六:表示结束时间(时间戳)
		//返回的结果是统计之后的结果
		public function countGroupCommentWithStatus($groupID = null,$teacherID = null,
		$classStatus = null,$commentStatus = null,$startTime = null,$endTime = null){
			if(is_null($groupID)){
				return -1;
			}

			$teaCondition = " and 1=1 ";
			if(!is_null($teacherID)){
				$teaCondition = $teaCondition." and tp_class.teacherID={$teacherID} ";
			}

			import("Home.Action.GlobalValue.GlobalValue");
			//如果传入的数据为null,则默认是正常上课
			if(is_null($classStatus)){
				$classStatus = GlobalValue::haveClass;
			}
			$classStatusResult = explode(":",$classStatus);
			$classStatusCondition = "( 1=2 ";
			foreach ($classStatusResult as $key => $value) {
				if(GlobalValue::haveClass == $value){
					$classStatusCondition .= " or tp_groupclasssch.gclassStatus=1 or
					tp_groupclasssch.gclassStatus=3 or tp_groupclasssch.gclassStatus=4";
				}elseif(GlobalValue::notClass == $value){
					$classStatusCondition .= " or tp_groupclasssch.gclassStatus=0 ";
				}
			}
			$classStatusCondition .= ")";

			$commentStatusCondition = " null ";
			$temCommentStatusResult = explode("&",$commentStatus);
			foreach ($temCommentStatusResult as $key => $value) {
				$commentStatusCondition .= " or gclassStatus='{$value}'";
			}

			$inquiry = new Model("groupclasssch");
			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry->join("inner join tp_group on tp_group.groupID=tp_groupclasssch.groupID
				 and {$classStatusCondition} and tp_groupclasssch.isdelete=0
				 inner join tp_class on tp_class.classID=tp_groupclasssch.classID {$teaCondition}
				 inner join tp_groupteachercom on tp_groupclasssch.gteacherComment=tp_groupteachercom.
				 groupTeacherComID ")
				 ->count("{$temCommentStatusResult}");
			 }else{
				 $result = $inquiry->join("inner join tp_group on tp_group.groupID=tp_groupclasssch.groupID
 				 and {$classStatusCondition} and tp_groupclasssch.isdelete=0
 				 inner join tp_class on tp_class.classID=tp_groupclasssch.classID {$teaCondition} and
				 tp_class.classStartTime>={$startTime} and tp_class.classEndTime<={$endTime}
 				 inner join tp_groupteachercom on tp_groupclasssch.gteacherComment=tp_groupteachercom.
 				 groupTeacherComID ")
 				 ->count("{$temCommentStatusResult}");
			 }
			 return $result;
		}

	}
