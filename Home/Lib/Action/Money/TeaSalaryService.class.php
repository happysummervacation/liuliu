<?php
	/*
	*俞鹏泽
	*该类主要是用来处理教师相关的操作,主要用于控制器,Action的操作
	*/
	class TeaSalaryService extends Action{
		/*
		*俞鹏泽
		*查找某教师在指定时间内的薪水设定分布
		*/
		//参数一:表示是哪个教师
		//参数二:表示所上的课程类型  [暂时不支持课程类该数据]
		//参数三:表示要查询哪些字段
		//参数四:表示指定时间的开始时间(时间戳)
		//参数五:表示指定时间的结束时间
		public function getTeacherOneClassSalarySet($teacherID = null,$classType = null,$field = null,
		$startTime = null,$endTime = null){
			if(is_null($teacherID)){
				return null;
			}
			// $classTypeString = " and 1=1";
			$fieldString = "";
			$fieldString = transformFieldToFieldString($field);

			$inquiry = new Model("teoneclasssalary");
			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry
				->join("inner join tp_packageconfig on tp_packageconfig.packageconID=
				tp_teoneclasssalary.scategory")
				->where("teacherID={$teacherID}")
				->field("{$fieldString}")
				->select();
			}else{
				$result = $inquiry
				->join("inner join tp_packageconfig on tp_packageconfig.packageconID=
				tp_teoneclasssalary.scategory")
				->where("teacherID={$teacherID} and
				((vStartTime>={$startTime} and vEndTime<={$endTime}) ||
				(vStartTime<={$startTime} and vEndTime>={$startTime}) ||
				(vStartTime<={$endTime} and vEndTime>={$endTime}))")
				->field("{$fieldString}")
				->select();
			}
			return $result;
		}

	}
