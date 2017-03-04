<?php
	class PublicFunction{
		/*
		*俞鹏泽
		*获取中国时间
		*/
		public static function getTime(){
			  //设置中国时间
			  date_default_timezone_set("PRC");
			  //返回时间戳
			  return time();
		}

		/*
		*俞鹏泽
		*划分url,获取url中的各个部分的信息
		*/
		public static function path_info($filepath){
	        $path_parts = array();
	        $path_parts ['dirname'] = rtrim(substr($filepath, 0, strrpos($filepath, '/')),"/")."/";
	        $path_parts ['basename'] = ltrim(substr($filepath, strrpos($filepath, '/')),"/");
	        $path_parts ['extension'] = substr(strrchr($filepath, '.'), 1);
	        $path_parts ['filename'] = ltrim(substr($path_parts ['basename'], 0, strrpos($path_parts ['basename'], '.')),"/");
	        return $path_parts;
    	}

		/*
		*作者：俞鹏泽
		*作用：获取某一时间的一周的开始时间与一周的结束时间
		*/
		//返回的数据是数组，第一个数据是一周开始时间，第二个数据是一周的结束时间
		public static function GetThisWeekStartEndTime(){
			$time = PublicFunction::GetTime();
			$week = date('w',$time);
			$week_start_time = strtotime(date('Y-m-d',$time)." -".($week?$week-1:6)." days");
			$week_end_time = strtotime(date('Y-m-d',$time)." +".($week?8-$week:1)." days");
			$arr = array();
			array_push($arr, $week_start_time);
			array_push($arr, $week_end_time);
			return $arr;
		}

		/*
		*作者：俞鹏泽
		*作用：获取本月的开始时间与结束时间
		*/
		//返回数据数组，第一个数据是开始时间，第二个数据是结束时间
		public static function GetThisMonthStartEndTime(){
			$time = (int)PublicFunction::GetTime() - 3600*24;   //表示获取上一个月的时间
			$month_start_time = strtotime(date('Y-m',$time));
			$month_end_time = strtotime(date('Y-m-d H:i:s',$month_start_time).' +1 month');
			$arr = array();
			array_push($arr, $month_start_time);
			array_push($arr, $month_end_time);
			return $arr;
		}
	}
