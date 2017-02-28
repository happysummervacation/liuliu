<?php
	class OrderPackageFeatureService extends Action{
		/*
		*俞鹏泽
		*处理学生的预定的还没有上过的课程以及对应的订购的套餐的数据
		*/
		public static function dealOrderPackageAndOrderClass($orderPacResult = null,$orderClaResult = null){
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
					$tem['packageNum'] = ((int)$value['classNumber']
					+(int)$value['otherClass']-(int)$value['haveClass']);
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
					array_push($resultArray,$tem);
				}
				return $resultArray;
			}else{
				//表示订购的套餐数据以及订购的课程数据都不为null
				//这种情况还没有进行处理
				return null;
			}
		}
	}
 ?>
