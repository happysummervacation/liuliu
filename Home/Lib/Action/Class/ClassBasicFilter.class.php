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
				$time = strtotime("{$value['year']}-{$value['date']}-{$value['time']}");
				array_push($timeStampArray,$time);
			}

			return $timeStampArray;
		}
	}
 ?>
