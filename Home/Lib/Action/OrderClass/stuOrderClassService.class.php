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
			$packageCondition = "";
			if(!is_null($orderPackageID)){
				$packageCondition = " and orderpackageID={$orderPackageID}";
			}

			$inquiry = new Model("oneorderclass");
			$result = $inquiry->join("inner join tp_class on tp_class.classID=tp_oneorderclass.classID and
			 tp_oneorderclass.isdelete=0 and studentID={$studentID} {$packageCondition}")
			 ->field("{$fieldString}")
			 ->select();

			return $result;
		}
	}
