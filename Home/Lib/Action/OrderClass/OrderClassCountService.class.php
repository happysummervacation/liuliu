<?php
	/*
	*俞鹏泽
	*该类专门用来统计关于各种条件的订购课程
	*/
	class OrderClassCountService extends Action{
		/************************学生的相关统计**********************************/
		/*
		*俞鹏泽
		*统计学生预定的一对一的课程数量
		*/
		//参数一:表示学生
		//参数二:表示教师的类型   0表示中教,1表示外教
		public function countStudentOrderClassNum($studentID = null,$teacherType = null){
			if(is_null($studentID) || is_null($teacherType)){
				return -1;
			}

			$inquiry = new Model();
			$sql = "select count(classStatus=0 or null) from tp_oneorderclass
			inner join tp_orderpackage on tp_orderpackage.orderpackageID=
			tp_oneorderclass.orderpackageID and tp_oneorderclass.tudentID={$studentID}
			and teacherNation={$teacherType}";
			$result = $inquiry->execute($sql);
			return $result;
		}

		/*
		*俞鹏泽
		*统计学生已上的一对一课程数量
		*/
		public function countStudentHaveClassNum($studentID = null,$teacherType = null){
			if(is_null($studentID) || is_null($teacherType)){
				return -1;
			}

			$inquiry = new Model();
			$sql = "select count(classStatus=1 or classStatus=3 or classStatus=4 or null)
			from tp_oneorderclass
			inner join tp_orderpackage on tp_orderpackage.orderpackageID=
			tp_oneorderclass.orderpackageID and tp_oneorderclass.tudentID={$studentID}
			and teacherNation={$teacherType}";

			$result = $inquiry->execute($sql);
			return $result;
		}
		/*****************************************************************/
	}
