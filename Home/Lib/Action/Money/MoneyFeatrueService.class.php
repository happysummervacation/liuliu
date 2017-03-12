<?php
	/*
	*该类用于一些提供特殊的数据处理服务
	*/
	class MoneyFeatrueService extends Action{
		/*陈泽奇
		*处理老师一对一价格表的信息;
		*返回一个友好的array数组;
		*/
		////////////////////////需要做修改////////////////////////////////
		public static function dealOneClassInfo($data = null){
			$message = array();
			if(is_null($data)){
				return $message;
			}else{
				$result = array();
				for($i=0;$i<count($data);$i++){
					$result[$i]['classtype'] = $data[$i]['packageconID']."|".$data[$i]['packageName'];
					if($data[$i]['teacherType'] == 0){
						$result[$i]['teachertype'] = $data[$i]['teacherType']."|普教";
					}elseif($data[$i]['teacherType'] == 1){
						$result[$i]['teachertype'] = $data[$i]['teacherType']."|名师";
					}
					$result[$i]['money'] = $data[$i]['price'];
					$result[$i]['infomationid'] = $data[$i]['teOneClassSalaryID'];
				}
				return $result;
			}
		}

		/*
		*俞鹏泽
		*用来处理上传上来的教师工资的信息
		*/
		//参数一:要处理的json字符串的数据
		//数据的意义,101_1_0_20_1 , 101:主键  1:课程类型  0:普通  20:价格  1表示是否是任教
		//返回数据是:要进行更新数组,不要
		public static function dealTeacherSalaryInfo($data = null){
			if(is_null($data)){
				return null;
			}

			$data = json_decode($data);   //解析json字符串
			$updateArray = array();
			$deleteArray = array();
			$addArray = array();

			foreach ($data as $key => $value) {
				$tem = "";
				$tem = explode("_",$value);
				if(count($tem) == 5){
					if(1 == $tem[4] || "1" == $tem[4]){
						array_push($updateArray,$tem);  //表示有数据被修改了
					}else{
						array_push($deleteArray,$tem);	//表示相比之前是不任教了
					}
				}else{
					array_push($addArray,$tem);   //新增的任教数据
				}
			}
			$returnData = array();
			$returnData['update'] = $updateArray;
			$returnData['add'] = $addArray;
			$returnData['delete'] = $deleteArray;

			return $returnData;
		}
	}
 ?>
