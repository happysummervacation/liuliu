<?php
	class ClassBasicFilter extends Action{
		/*
		*俞鹏泽
		*将传入的时间格式数组转换成时间戳的数组
		*/

		public static function transformTimeStrToTimeStamp($timeStr = null){
			$timeStampArray = array();
			if(is_null($timeStampArray)){
				return $timeStampArray;
			}

			foreach ($timeStr as $key => $value) {
				$time = "";
				$time = strtotime("{$value['year']}-{$value['date']} {$value['time']}");
				array_push($timeStampArray,$time);
			}

			return $timeStampArray;
		}

		/*
		*俞鹏泽
		*根据教师开放的课程信息,订购该教师的课程信息,已将当前时间(用来区分课程是否过期)来获取各种课程状态
		*/
		public static function getClassStatusWithCondition($openClassResult = null,$oneOrderClassResult = null,$nowTime = null){
			if(is_null($openClassResult) || is_null($oneOrderClassResult)){
				return null;
			}
			if(is_null($nowTime)){
				$nowTime = getTime();
			}

			$returnData = array();
			foreach ($openClassResult as $key => $value) {
				$tem = array();
				$tem['time'] = (int)$value['classStartTime']*1000;
				$tem['student'] = "";
				$tem['state'] = 0;
				if($value['classEndTime'] < $nowTime){
					$tem['state'] = 0;   //表示过期
				}else{
					$tem['state'] = 1;   //表示开放课程了但是还没有预定
				}

				foreach ($oneOrderClassResult as $o_key => $o_value) {
					if($o_value['classID'] == $value['classID']){
						if(0 == (int)$o_value['classStatus']){    //表示订购课程了但是还没有进行上课
							$tem['student'] = $o_value['account'];
							$tem['state'] = 2;
						}elseif(1 == (int)$o_value['classStatus']){  //表示正常上课
							$tem['student'] = $o_value['account'];
							$tem['state'] = 3;
						}elseif(5 == (int)$o_value['classStatus']){  //表示教师缺课
							$tem['student'] = $o_value['account'];
							$tem['state'] = 4;
						}elseif(7 == (int)$o_value['classStatus']){   //表示意外情况
							$tem['student'] = $o_value['account'];
							$tem['state'] = 6;
						}
					}
				}

				array_push($returnData,$tem);
			}

			return $returnData;
		}

	}
 ?>
