<?php
	class ClassBasicService extends Action{
		private $reClassTime = 1800;  //外教一节课的时间差
		private $chClassTime = 3600;  //中教一节课的时间差

		public function __construct(){
            //获取教师类型
        }
		/*
		*俞鹏泽
		*开发教师的有空时间段
		*/
		//参数一:教师的ID
		//参数二:课程数据
		//插入课程开放ID,其值是课程开放时间+教师ID的MD5加密值
		public function Opencourse($teacherID = null,$classData = null){
			$message = array();
			if(is_null($teacherID) || is_null($classData)){
				$message['status'] = false;
				$message['message'] = "开放课程失败";
				return $message;
			}

			$classPeriod = 0;
			/***************   准备数据     ***********/
			import("Home.Action.User.UserBasicOperate");
			$userOp = new UserBasicOperate();
			$field = array();
			array_push($field,"teacher_type");
			$teacherType = $userOp->getUserInfo("register",$teacherID,null,null,null,$field);
			if(empty($teacherType)){
				$message['status'] = false;
				$message['message'] = "开放课程失败";
				return $message;
			}elseif($teacherType[0]['teacher_type'] == 0 ||$teacherType[0]['teacher_type'] == "0"){
				$classPeriod = $this->chClassTime;
			}else{
				$classPeriod = $this->reClassTime;
			}
			/************   ************/

			import("Home.Action.Class.ClassBasicFilter");
			import("Home.Action.Class.ClassBasicOperate");
			//获取转换的之后的时间戳数组
			$dealClassData = ClassBasicFilter::transformTimeStrToTimeStamp($classData);
			//指定要添加的字段名
			$fieldData = array();
			array_push($fieldData,"classID","teacherID","classStartTime","classEndTime","createTime","lastModify");

			$Data = array();
			foreach ($dealClassData as $key => $value) {    //$value的值时间戳的数值
				$tem = array();
				array_push($tem,md5($value.$teacherID),$teacherID,$value,(int)$value+$classPeriod,getTime(),getTime());
				array_push($Data,$tem);
			}

			$inquiry = new Model();
			$inquiry->startTrans();    //开启事务

			$classBasOp = new ClassBasicOperate();
			$result = $classBasOp->batchAddClassInfo($fieldData,$Data);

			if($result['status']){
				$inquiry->commit();
				return $result;
			}else{
				$inquiry->rollback();
				return $result;
			}
		}
	}
 ?>
