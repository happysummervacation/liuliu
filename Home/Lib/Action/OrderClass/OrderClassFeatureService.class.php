<?php
	class OrderClassFeatureService extends Action{
		/*
		*俞鹏泽
		*处理前台传过来的订购课程的数据
		*/
		//需要返回的数据
		//1.使用到的学生订购的套餐数据
		//2.根据不同的订购的套餐对订购的课程数据进行分类
		/*流程:
		1.
		*/
		/*
		返回的数据示例:
		array(1) {
		  [1] => array(4) {    --------------------->这里的1表示订购的套餐的ID号
		    [0] => string(32) "bf731dfca91f84904a4bdbfbb9ad677b"   ------->这些是对应的课程ID号(即开放时间段的ID)
		    [1] => string(32) "6d12f5b39bc679e6232ebe24c38dddcc"
		    [2] => string(32) "923c478f5e5f921ded6fd26b22d85249"
		    [3] => string(32) "aa43b5b1de01c976756eea258ba8db3f"
		  }
		}
		*/
		public static function dealOrderClassData($Data = null){
			if(is_null($Data)){
				return null;
			}

			$returnData = array();
			//将json字符串转成数组
			$dataArray = json_decode($Data,true);
			if(count($dataArray) == 0){
				return null;
			}else{
				//将获取到的数据字符串按照不同的订购的套餐进行分类
				foreach ($dataArray as $key => $value) {
					if(empty($returnData[$value['package_id']])){
						$returnData[$value['package_id']] = array();
						array_push($returnData[$value['package_id']],$value['class_id']);
					}else{
						array_push($returnData[$value['package_id']],$value['class_id']);
					}
				}
			}
			return $returnData;
		}

		/*
		*俞鹏泽
		*创建订购课程的数据
		*/
		public static function createOrderClassData($studentID = null,$classID = null,$orderPackageID = null){
			if(is_null($studentID) || is_null($classID) || is_null($orderPackageID)){
				return array();
			}

			$orderClassData = array();
			$orderClassData['studentID'] = $studentID;
			$orderClassData['classID'] = $classID;
			$orderClassData['orderpackageID'] = $orderPackageID;
			$orderClassData['createtime'] = getTime();

			return $orderClassData;
		}

		/*
		*俞鹏泽
		*判断两个时间集合是否有时间交集(主要是用来判断课程时间是否有重复)
		*如果有时间交集就直接进行返回false,如果没有时间交集就返回true
		*/
		public static function JudgeTimes($firstTime = null,$secondTime = null){
			if(is_null($firstTime) || is_null($secondTime)){
				return true;   //表示没有时间交集
			}

			foreach ($firstTime as $f_key => $f_value) {
				foreach ($secondTime as $s_key => $s_value) {
					if((int)$f_value['classStartTime'] > (int)$s_value['classEndTime'] ||
					(int)$f_value['classEndTime'] < (int)$s_value['classStartTime']){

					}else{
						return false;
					}
				}
			}

			//跳出循环表示没有重复的时间段
			return true;
		}

		/*
		*俞鹏泽
		*判断卡类套套餐是否有同一天的数据
		*/
		//如果有同一天的数据,返回false;
		//如果都没有同一天的数据,就true;
		public static function JudgeSameDay($time = null){
			if(is_null($time)){
				return true;
			}

			$judgeArray = array();
			foreach ($time as $key => $value) {
				//$value是时间戳
				$day = date('Y-m-d',$value);
				if(empty($judgeArray[$day])){
					$judgeArray[$day] = 0;
				}else{
					return false;
				}
			}
			//跳出循环表示没有同一天的数据
			return true;
		}
	}
 ?>
