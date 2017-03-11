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
			if(is_null($studentID)){
				return -1;
			}

			// $inquiry = new Model();
			// $sql = "select count(classStatus=0 or classStatus=1 or classStatus=3 or classStatus=4 or null) as num
			// from tp_oneorderclass
			// inner join tp_orderpackage on tp_orderpackage.orderpackageID=
			// tp_oneorderclass.orderpackageID and tp_oneorderclass.studentID={$studentID}
			// and teacherNation={$teacherType}";
			$inquiry = new Model();
			if(is_null($teacherType)){
				$sql = "select count(classStatus=0 or classStatus=1 or classStatus=3 or classStatus=4 or null) as num
				from tp_oneorderclass
				inner join tp_orderpackage on tp_orderpackage.orderpackageID=
				tp_oneorderclass.orderpackageID and tp_oneorderclass.studentID={$studentID}";
			}else{
				$sql = "select count(classStatus=0 or classStatus=1 or classStatus=3 or classStatus=4 or null) as num
				from tp_oneorderclass
				inner join tp_orderpackage on tp_orderpackage.orderpackageID=
				tp_oneorderclass.orderpackageID and tp_oneorderclass.studentID={$studentID}
				and teacherNation={$teacherType}";
			}
			$result = $inquiry->query($sql);

			return $result;
		}

		/*
		*俞鹏泽
		*统计学生已上的一对一课程数量
		*/
		public function countStudentHaveClassNum($studentID = null,$teacherType = null){
			if(is_null($studentID)){
				return -1;
			}

			$inquiry = new Model();
			if(is_null($teacherType)){
				$sql = "select count(classStatus=1 or classStatus=3 or classStatus=4 or null) as num
				from tp_oneorderclass
				inner join tp_orderpackage on tp_orderpackage.orderpackageID=
				tp_oneorderclass.orderpackageID and tp_oneorderclass.studentID={$studentID}
				and tp_orderpackage.packageType=0";
			}else{
				$sql = "select count(classStatus=1 or classStatus=3 or classStatus=4 or null) as num
				from tp_oneorderclass
				inner join tp_orderpackage on tp_orderpackage.orderpackageID=
				tp_oneorderclass.orderpackageID and tp_oneorderclass.studentID={$studentID}
				and teacherNation={$teacherType}";
			}

			$result = $inquiry->query($sql);
			return $result;
		}

		/*
		蒋周杰
		统计某一套餐的已用课时
		参数一：套餐订单ID
		*/
		public function getPackageHaveClass($studentID = null,$orderpackageID = null){
			if(is_null($orderpackageID) || is_null($studentID)){
				return null;
			}
			$inquiry = new Model();
			//dump($orderpackageID);
			$sql = "select count(classStatus=1 or classStatus=3 or classStatus=4 or null) as num
			from tp_oneorderclass
			inner join tp_orderpackage on tp_orderpackage.orderpackageID=
			tp_oneorderclass.orderpackageID and tp_oneorderclass.studentID={$studentID}
			and tp_orderpackage.orderpackageID={$orderpackageID}";
			$result = $inquiry->query($sql);
			return $result[0]['num'];
		}
		/*****************************************************************/

		/*
		蒋周杰
		统计教师Achieved Class
		*/
		public function getAchievedClass($teacherID){

		}
	}
