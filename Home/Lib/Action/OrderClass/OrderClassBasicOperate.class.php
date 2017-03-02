<?php
	class OrderClassBasicOperate extends Action{
		/*
		*俞鹏泽
		*统计某个学生使用某个订购的套餐订购的一对一类型的课程数量(其中课程状态值包含:未上和上过)
		*/
		//参数一:学生的ID  只能是单值
		public function countStudentOneOrderClassNum($studentID = null,$orderPackageID = null,$countCondition = null){
			//参数二:学生订购的套餐的ID  只能是单值
			if(is_null($studentID) || is_null($orderPackageID)){
				return -1;
			}

			$inquiry = new Model("oneorderclass");
			//查询指定订课套餐订购的还没有上的或者正常上过的课程数量
			if(is_null($countCondition)){
				$result = $inquiry->join("inner join tp_orderpackage on
				 tp_oneorderclass.orderpackageID=tp_orderpackage.orderpackageID
				  and tp_orderpackage.status=1 and tp_orderpackage.orderpackageID={$orderPackageID}")
				 ->count("tp_oneorderclass.classStatus=0 or tp_oneorderclass.classStatus=1 or null");
			 }else{
				 $result = $inquiry->join("inner join tp_orderpackage on
 				 tp_oneorderclass.orderpackageID=tp_orderpackage.orderpackageID
				  and tp_orderpackage.status=1 and tp_orderpackage.orderpackageID={$orderPackageID}")
 				 ->count("{$countCondition}");
			 }

			 return $result;
		}

		/*
		*俞鹏泽
		*判断指定学生的一对一套餐的各种统计
		*/
		//参数三:统计的条件是什么
		//参数四:查询的条件是什么
		public function countStudentOneOrderClassWithCon($studentID = null
		,$orderPackageID = null,$countCondition = null,$selectCondition = null){
			if(is_null($studentID) || is_null($orderPackageID)){
				return -1;
			}

			$inquiry = new Model('oneorderclass');
			if(is_null($countCondition)){
				if(is_null($selectCondition)){
					$result = $inquiry->join("inner join tp_orderpackage on
					 tp_oneorderclass.orderpackageID=tp_orderpackage.orderpackageID
					  and tp_orderpackage.orderpackageID={$orderPackageID}")->count();
				}else{
					$result = $inquiry->join("inner join tp_orderpackage on
					 tp_oneorderclass.orderpackageID=tp_orderpackage.orderpackageID
					  and tp_orderpackage.orderpackageID={$orderPackageID}")
					  ->where("{$selectCondition}")->count();
				}
			}else{
				if(is_null($selectCondition)){
					$result = $inquiry->join("inner join tp_orderpackage on
					 tp_oneorderclass.orderpackageID=tp_orderpackage.orderpackageID
					  and tp_orderpackage.orderpackageID={$orderPackageID}")->count("{$countCondition}");
				}else{
					$result = $inquiry->join("inner join tp_orderpackage on
					 tp_oneorderclass.orderpackageID=tp_orderpackage.orderpackageID
					  and tp_orderpackage.orderpackageID={$orderPackageID}")
					  ->where("{$selectCondition}")
					  ->count("{$countCondition}");
				}
			}
			return $result;
		}

		/*
		*俞鹏泽
		*将订课数据写入到数据库中
		*/
		public function addOneOrderClassData($Data = null){
			$message = array();
			if(is_null($Data)){
				$message['status'] = false;
				$message['message'] = "没有需要进行添加的数据";
				return $message;
			}

			$inquiry = new Model("oneorderclass");
			$result = $inquiry->add($Data);
			if($result){
				$message['status'] = true;
				$message['message'] = "添加一对一的课程数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加一对一的订课数据失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*修改订购的课程状态
		*/
		public function updateOneOrderClassInfo($oneOrderClassID = null,$Data = null){
			$message = array();
			if(is_null($oneOrderClassID) || is_null($Data)){
				$message['status'] = false;
				$message['message'] = "要修改必要数据为空";
				return $message;
			}

			$inquiry = new Model("oneorderclass");
			$result = $inquiry->where("oneorderclassID={$oneOrderClassID}")->save($Data);
			if($result || $result == 0){
				$message['status'] = true;
				$message['message'] = "修改订购一对一课程数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "修改订购一对一课程数据失败";
				return $message;
			}
		}

	}
 ?>
