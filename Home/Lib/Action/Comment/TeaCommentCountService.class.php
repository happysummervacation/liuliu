<?php
	/*
	*俞鹏泽
	*该类主要是用来统计与教师相关的一对一的课程评论的数据
	*/
	class TeaCommentCountService extends Action{
		/*
		*俞鹏泽
		*用来统计教师的一对一的课程评论数量
		*/
		//参数一:表示教师的ID[表示是哪个教师评论的]
		//参数二:表示该条评论的状态是怎么样的  多种评论条件查询时使用***:***:***&***:***:***的方式
		//参数三:表示查询规定时间内的评论数据的开始时间(时间戳)  如果时间有一个是null表示不对时间做限制
		//参数四:表示查询规定时间内的评论数据的结束时间(时间戳)
		public function countTeaComment($teacherID = null,$commentStatus = null,$startTime = null,
		$endTime = null){
			if(is_null($teacherID) || is_null($commentStatus)){
				return -1;
			}
			$temCommentStatusResult = explode("&",$commentStatus);

			$commentStatusCondition = " null ";
			foreach ($temCommentStatusResult as $key => $value) {
				$commentStatusCondition .= " or comStatus='{$value}'";
			}

			$inquiry = new Model("oneteachercom");
			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry->where("teacherID={$teacherID} and isdelete=0")
				->count("{$commentStatusCondition}");
			}else{
				$result = $inquiry->where("teacherID={$teacherID} and isdelete=0 and
				comDeadline>={$startTime} and comDeadline<={$endTime}")
				->count("{$commentStatusCondition}");
			}

			return $result;
		}
	}
