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

	}
 ?>
