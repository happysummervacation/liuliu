<?php
	class SystemBasicService extends Action{
		/*
		*俞鹏泽
		*修改系统设置
		*/
		public function updateSystemSetInfo($postData = null){
			$message = array();
			if(is_null($postData)){
				$message['status'] = false;
				$message['message'] = "没有要修改的数据";
				return $message;
			}

			$data = array();
			//这里加获取postData中的参数,并存放到$data数组中,并进行数据更新
			$data['appointCourseDeadline'] = ((int)$postData['appointCourseDeadline']*3600);
			$data['classRemindTime'] = ((int)$postData['classRemindTime']*3600);
			$data['cancelCourseDeadline'] = ((int)$postData['cancelCourseDeadline']*3600);
			$data['remindEndTime'] = ((int)$postData['remindEndTime']*3600);
			$data['remindStartTime'] = ((int)$postData['remindStartTime']*3600);
			$data['buttonEffectTime'] = ((int)$postData['buttonEffectTime']*60);
			$data['buttonLostTime'] = ((int)$postData['buttonLostTime']*60);
			$data['monthDeadline'] = ((int)$postData['monthDeadline']*3600);
			$data['weekDeadline'] = ((int)$postData['weekDeadline']*3600);
			$data['dayDeadline'] = ((int)$postData['dayDeadline']*3600);
			$data['groupDeadline'] = ((int)$postData['groupDeadline']*3600);
			$data['cancelClassRate'] = $postData['cancelClassRate'];

			import("Home.Action.System.SystemBasicOperate");

			$systemSet = new SystemBasicOperate();

			$result = $systemSet->updateSystemSet($data);

			if($result || $result == 0){
				$message['status'] = true;
				$message['message'] = "系统数据更新成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "系统数据更新失败";
				return $message;
			}
		}
	}
 ?>
