<?php
	class stuOrderClassService extends Action{
		/*
		*俞鹏泽
		*获取学生一对一课程的各种课程状态的数据
		*/
		//参数一:学生的ID
		//参数二:要查询的课程数据的状态,多种状态时使用****:****:****(暂时之后正常上课与还没有上课两种)
		//参数三:要查询的字段是什么
		public function getStudentOneOrderClassWithStatus($studentID = null,$classStatus = null,
			$orderPackageID = null,$field = null){
			if(is_null($studentID) || is_null($classStatus)){
				return null;
			}

			$fieldString = "";
			$fieldString = transformFieldToFieldString($field);

			import("Home.Action.GlobalValue.GlobalValue");
			$statusResult = "( 1=2 ";
			$classStatusResult = explode(":",$classStatus);
			//对课程状态进行获取
			foreach ($classStatusResult as $key => $value) {
				if($value == GlobalValue::notClass){
					$statusResult = $statusResult." or tp_oneorderclass.Status=0 ";
				}elseif($value == GlobalValue::haveClass){
					$statusResult = $statusResult." or tp_oneorderclass.Status=1 ";
				}
			}
			$statusResult = $statusResult.")";

			$packageCondition = "";
			if(!is_null($orderPackageID)){
				$packageCondition = " and orderpackageID={$orderPackageID}";
			}

			$inquiry = new Model("oneorderclass");
			$result = $inquiry->join("inner join tp_class on tp_class.classID=tp_oneorderclass.classID and
			 tp_oneorderclass.isdelete=0 and studentID={$studentID} {$packageCondition} and {$statusResult}")
			 ->field("{$fieldString}")
			 ->select();

			return $result;
		}

		/*
		*俞鹏泽
		*查询使用某个套餐正常完成课程的第一节课的上课时间(针对一对一课程)
		*/
		public function getStudentFirstOrderClass($studentID = null,$orderPackageID = null){
			if(is_null($studentID) || is_null($orderPackageID)){
				return null;
			}
			$inquiry = new Model("oneorderclass");
			$result = $inquiry->join("inner join tp_orderpackage on tp_orderpackage.orderpackageID=tp_oneorderclass.
			orderpackageID and tp_oneorderclass.studentID={$studentID} and tp_orderpackage.orderpackageID=
			{$orderPackageID} and (tp_oneorderclass.classStatus=1 or tp_oneorderclass.classStatus=3 or
			tp_oneorderclass.classStatus=4) and tp_oneorderclass.isdelete=0")
			->join('inner join tp_class on tp_class.classID=tp_oneorderclass.classID')
			->field("classStartTime")
			->order("classStartTime asc")
			->find();

			return $result['classStartTime'];
		}
	}
