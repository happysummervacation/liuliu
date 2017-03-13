<?php
	class OrderPackageFeatureService extends Action{
		/*
		*俞鹏泽
		*处理学生的预定的还没有上过的课程以及对应的订购的套餐的数据
		*/
		public static function dealOrderPackageAndOrderClass($orderPacResult = null,
		$orderClaResult = null){
			if(is_null($orderPacResult)){
				return null;
			}

			$resultArray = array();
			/*
			表示学生还没有使用订购的套餐订购过课程
			*/
			if(is_null($orderClaResult)){
				foreach ($orderPacResult as $key => $value) {
					$tem = array();
					$temString = "";

					$tem['orderpackageID'] = $value['orderpackageID'];
					// $tem['packageNum'] = ((int)$value['classNumber']
					// +(int)$value['otherClass']);

					if(0 == $value['packageType']){
						$tem['packageNum'] = ((int)$value['classNumber']
						+(int)$value['otherClass']);
					}elseif(1 == $value['packageType']){
						$tem['packageNum'] = (int)$value['haveClass'];
					}

					if((int)$value['packageType'] == 0){
						$temString = "课时类";
					}else{
						$temString = "卡类";
					}
					if((int)$value['classType'] == 0){
						$temString = $temString."一对一";
					}else{
						$temString = $temString."小班课";
					}
					$tem['packageName'] = $temString.$value['packageName'];
					$tem['packageType'] = $value['packageType'];
					array_push($resultArray,$tem);
				}
				return $resultArray;
			}else{
				//表示订购的套餐数据以及订购的课程数据都不为null
				//这种情况还没有进行处理
				for ($i = 0; $i < count($orderPacResult); $i++) {
					$tem = array();
					$temString = "";

					$tem['orderpackageID'] = $orderPacResult[$i]['orderpackageID'];
					// $tem['packageNum'] = ((int)$orderPacResult[$i]['classNumber']
					// +(int)$orderPacResult[$i]['otherClass'] - (int)$orderClaResult[$i]['haveClass']);

					if(0 == $orderPacResult[$i]['packageType']){
						$tem['packageNum'] = ((int)$orderPacResult[$i]['classNumber']
					+(int)$orderPacResult[$i]['otherClass'] - (int)$orderClaResult[$i]['haveClass']);
					}elseif(1 == $orderPacResult[$i]['packageType']){
						$tem['packageNum'] = (int)$orderClaResult[$i]['haveClass'];
					}

					if((int)$orderPacResult[$i]['packageType'] == 0){
						$temString = "课时类";
					}else{
						$temString = "卡类";
					}
					if((int)$orderPacResult[$i]['classType'] == 0){
						$temString = $temString."一对一";
					}else{
						$temString = $temString."小班课";
					}
					$tem['packageName'] = $temString.$orderPacResult[$i]['packageName'];
					$tem['packageType'] = $orderPacResult[$i]['packageType'];   //0表示课时类  1表示卡类
					array_push($resultArray,$tem);
				}
				return $resultArray;
			}
		}

		/*
		*俞鹏泽
		*根据学生的订购的套餐的数据,获取学生的订购的已经上过的课程的数量数据并进行处理
		*/
		//这里暂时只有一对一的课程数量统计
		public function dealOrderPackageOrderClassData($studentID = null,$OrderPackages = null){
			if(is_null($OrderPackages) || is_null($studentID)){
				return null;
			}

			import("Home.Action.OrderClass.OrderClassBasicOperate");
			$orderClassFeaOp = new OrderClassBasicOperate();

			$onesql = "classType=0";
			$oneCountSql = "tp_oneorderclass.classStatus=1 or null";

			for ($i = 0; $i < count($OrderPackages); $i++) {
				if((int)$OrderPackages[$i]['classType'] == 0){ //一对一的套餐
					$oneTemResult = 0;
					$oneTemResult = $orderClassFeaOp->countStudentOneOrderClassWithCon($studentID,
					$OrderPackages[$i]['orderpackageID'],$oneCountSql,$onsql);
					$OrderPackages[$i]['haveClass'] = $oneTemResult;
				}else{       //表示是小班的套餐     //小班的数量统计还没有

				}
			}

			return $OrderPackages;
		}
	}
 ?>
