<?php
	class OrderClassBasicService extends Action{
		/*
		*俞鹏泽
		*订购一对一的课程数据
		*/
		public function OrderOneToOneClass($studentID = null,$data = null){
			$message = array();
			if(is_null($studentID) || is_null($data)){
				$message['status'] = false;
				$message['message'] = "必要的信息没有指定";
				return $message;
			}


		}
	}
 ?>
