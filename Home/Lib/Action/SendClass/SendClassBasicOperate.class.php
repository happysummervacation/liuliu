<?php
	class SendClassBasicOperate extends Action{
		/*
		*俞鹏泽
		*添加赠送课程的数据
		*/
		public function addSendClassInfo($Data = null){
			$message = array();

			if(is_null($Data)){
				$message['status'] = false;
				$message['message'] = "没有要添加的数据";
				return $message;
			}

			$inquiry = new Model("sendclassnum");
			$result = $inquiry->add($Data);
			if($result){
				$message['status'] = true;
				$message['message'] = "赠送课程的数据添加成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "赠送课程数的数据添加失败";
				return $message;
			}
		}
	}
 ?>
