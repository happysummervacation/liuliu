<?php
	class StopClassBasicService extends Action{
		/*
		*俞鹏泽
		*判断某个学生的指定时间是否在停课时间内,如果是就返回停课状态的信息,如果不是就设置对应的停课数据为无效状态
		*如果设置停课数据为无效时,还要设置当前有效的套餐的时间进行有效期的延迟
		*/
		public function checkAndUpdateStopClassTime($studentID = null,$time = null){
			$message = array();
			if(is_null($studentID)){
				$message['status']  = false;
				$message['message'] = "缺乏重要的查询数据";
				return $message;
			}
			if(is_null($time)){
				$time = getTime();
			}

			//先获取是否有在停课时间内的停课记录
			$inquiry = new Model("stopclass");
			$sql = "select count(*) from tp_stopclass where status=1 and stopClassTime<{$time} and
			stopEndTime>{$time} and isdelete=0 and studentID={$studentID}";
			$stopClassNum = $inquiry->query($sql);
			if($stopClassNum > 0){
				$message['status'] = true;
				$message['message'] = "该学生处在停课时间内";
				$message['isStop'] = true;
				return $message;
			}else{
				//获取是否具有超过停课结束时间,但是还没有进行处理的数据
				$sql = "select stopclassID,stopStartTime,stopEndTime from tp_stopclass
				where status=1 and stopEndTime<{$time} and
				isdelete=0 and studentID={$studentID}";
				$stopClassResult = $inquiry->query($sql);
				if($stopClassResult){
					$this->dealStudentActiveOrderPacAndStopClass($studentID,$stopClassResult);
				}else{
					$message['status'] = true;
					$message['message'] = "没有要处理的数据";
					$message['isStop'] = false;
					return $message;
				}
			}
		}

		/*
		*俞鹏泽
		*获取学生的有效状态的套餐,如果有就对其进行有效时间的延期,如果没有直接pass
		*/
		private function dealStudentActiveOrderPacAndStopClass($studentID = null,$stopClassResult = null){
			if(is_null($studentID) || is_null($stopClassResult)){
				return;
			}

			//获取学生的有效的套餐
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			$orderPacOp = new OrderPackageBasicOperate();
			$orderPacResult = $orderPacOp->getStuActiveOrderPackageInfo($studentID);
			if(!$orderPacResult){ //如果没有有效状态的套餐直接进行退返回
				return;
			}else{
				$inquiry = new Model();
				foreach ($stopClassResult as $key => $value) {
					$period = (int)$value['stopEndTime']-(int)$value['stopStartTime'];
					foreach ($orderPacResult as $o_key => $o_value) {
						$sql = "update tp_orderpackage set endTime=endTime+({$period}) where
						orderpackageID={$o_value['orderpackageID']}";
						$temResult = $inquiry->execute($sql);  //只做处理,不做判断
					}

					$sql = "update tp_stopclass set failureTime=stopEndTime,status=0 where
					stopclassID={$value['stopclassID']}";

					$stopClassDealResult = $inquiry->execute($sql);   //只做处理,不做判断
				}
				return;
			}
		}
	}
