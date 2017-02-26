<?php
	class SystemBasicOperate extends Action{
		public function getSystemSet(){
			$inquiry = new Model("systemset");
			$result = $inquiry->select();
			return $result[0];
		}

		/*
		*俞鹏泽
		*更新系统的参数
		*/
		public function updateSystemSet($Data = null){
			$message = array();
			if(is_null($Data)){
				$message['status'] = false;
				$message['message'] = "没有要更新的数据";
				return $message;
			}

			$inquiry = new Model("systemset");
			$result = $inquiry->where("systemID=1")->save($Data);

			if($result || $result == 0 || $result != false){
				$message['status'] = true;
				$message['message'] = "更新系统参数成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "更新系统参数失败";
				return $message;
			}
		}
	}
 ?>
