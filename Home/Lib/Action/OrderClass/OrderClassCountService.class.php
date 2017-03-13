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

		/*
		*俞鹏泽
		*统计某个教师在某段时间内所上的各种状态的一对一课程的数量
		*/
		//参数一:表示某个教师
		//参数二:表示所上的课程类型
		//参数三:表示课程的状态   多种状态是使用 ****:****:****  如果是null则默认是正常上课的状态
		//参数四:表示开始时间(时间戳)  (表示课程的开始时间)
		//参数五:表示结束时间         (表示课程的结束时间)
		public function countTeaHaveClass($teacherID = null,$classCategory = null,$classStatus = null,
		$startTime = null,$endTime = null){
			if(is_null($teacherID)){
				return -1;
			}

			import("Home.Action.GlobalValue.GlobalValue");
			if(is_null($classStatus)){
				$classStatus = GlobalValue::haveClass;
			}

			$statusResult = explode(":",$classStatus);
			$statusString = "( null ";
			//这里暂时只有正常上课,没有上课,教师缺课,教师退课四种
			foreach ($statusResult as $key => $value) {
				if(GlobalValue::notClass == $value){
					$statusString = $statusString." or tp_oneorderclass.classStatus=0 ";
				}elseif(GlobalValue::haveClass == $value){
					$statusString = $statusString." or tp_oneorderclass.classStatus=1 or tp_oneorderclass.
					classStatus=3 or tp_oneorderclass.classStatus=4 ";
				}elseif(GlobalValue::teaMissClass == $value){
					$statusString = $statusString." or tp_oneorderclass.classStatus=5";
				}elseif(GlobalValue::teaCancelClass == $value){
					$statusString = $statusString." or tp_oneorderclass.classStatus=6";
				}
			}
			$statusString = $statusString.")";

			$inquiry = new Model("oneorderclass");
			if(is_null($startTime) || is_null($endTime)){
				$result = $inquiry
				->join("inner join tp_class on tp_class.classID=tp_oneorderclass.
				classID and tp_oneorderclass.isdelete=0 and tp_class.teacherID={$teacherID}
				inner join tp_orderpackage on tp_orderpackage.orderpackageID=tp_oneorderclass.
				orderpackageID and category={$classCategory}")
				->count("{$statusString}");
			}else{
				$result = $inquiry->join("inner join tp_class on tp_class.classID=tp_oneorderclass.
				classID and tp_oneorderclass.isdelete=0 and tp_class.teacherID={$teacherID} and
				tp_class.classStartTime>={$startTime} and tp_class.classEndTime<={$endTime}
				inner join tp_orderpackage on tp_orderpackage.orderpackageID=tp_oneorderclass.
				orderpackageID and category={$classCategory}")
				->count("{$statusString}");
			}
			return $result;
		}
	}
