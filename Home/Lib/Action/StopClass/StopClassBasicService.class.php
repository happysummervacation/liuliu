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
			$sql = "select count(*) from tp_stopclass where status=1 and stopStartTime<{$time} and
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
					$this->dealStudentActiveOrderPacAndStopClass($studentID,$stopClassResult,0);
					$message['status'] = true;
					$message['message'] = "已经处理了要处理的停课数据,成功与否不能进行保证";
					$message['isStop'] = false;
					return $message;
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
		//参数一:学生的ID
		//参数二:停课数据集合
		//参数三:取消类别,0表示超过停课结束时间的停课取消,1表示还在停课时间内的停课的取消
		private function dealStudentActiveOrderPacAndStopClass($studentID = null,$stopClassResult = null,$type = null){
			if(is_null($studentID) || is_null($stopClassResult) || is_null($type)){
				return;
			}

			//获取学生的有效的套餐
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			$orderPacOp = new OrderPackageBasicOperate();
			$orderPacResult = $orderPacOp->getStuActiveOrderPackageInfo($studentID);
			if(0 == (int)$type){
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
			}elseif(1 == (int)$type){
				if(!$orderPacResult){ //如果没有有效状态的套餐直接进行退返回
					return;
				}else{
					$inquiry = new Model();
					foreach ($stopClassResult as $key => $value) {
						$nowTime = getTime();
						$period = (int)$nowTime -(int)$value['stopStartTime'];
						foreach ($orderPacResult as $o_key => $o_value) {
							$sql = "update tp_orderpackage set endTime=endTime+({$period}) where
							orderpackageID={$o_value['orderpackageID']}";
							$temResult = $inquiry->execute($sql);  //只做处理,不做判断
						}

						$sql = "update tp_stopclass set failureTime={$nowTime},status=0 where
						stopclassID={$value['stopclassID']}";

						$stopClassDealResult = $inquiry->execute($sql);   //只做处理,不做判断
						if($stopClassDealResult){
							return true;
						}else{
							return false;
						}
					}
					return;
				}
			}else{
				return;
			}
		}

		/*
		*俞鹏泽
		*添加学生的停课申请记录
		*/
		//参数一:学生的ID
		//参数二:操作者的ID
		//参数三:停课的开始时间
		//参数四:停课的结束时间
		public function addStudentStopClassInfoService($studentID = null,$operaterID = null,
		$startTime = null,$endTime = null,$reason = ""){
			$message = array();
			if(is_null($studentID) || is_null($operaterID) || is_null($startTime) || is_null($endTime)){
				$message['status'] = false;
				$message['message'] = "缺乏重要的停课数据,停课操作失败";
				return $message;
			}

			$data['studentID'] = $studentID;
			$data['operaterID'] = $operaterID;
			$data['stopStartTime'] = $startTime;
			$data['stopEndTime'] = $endTime;
			$data['reason'] = $reason;
			$data['createTime'] = getTime();
			$inquiry = new Model("stopclass");
			$addResult = $inquiry->add($data);
			if($addResult){
				$message['status'] = true;
				$message['message'] = "添加停课数据成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "添加停课数据失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*取消学生的停课数据(同时对学生所有有效套餐进行延期)
		*/
		//现获取对应的停课数据的学生ID
		public function cancelStudentStopClass($stopClassID = null){
			$message = array();
			if(is_null($stopClassID)){
				$message['status'] = false;
				$message['message'] = "缺乏修改的重要数据";
				return $message;
			}
			$inquiry = new Model("stopclass");
			$stopClassResult = $inquiry
			->field("studentID,stopclassID,stopStartTime,stopEndTime")
			->where("stopclassID={$stopClassID}")
			->select();
			$result = $this->dealStudentActiveOrderPacAndStopClass($stopClassResult[0]['studentID'],$stopClassResult,1);
			if($result){
				$message['status'] = true;
				$message['message'] = "取消停课成功";
				return $message;
			}else{
				$message['status'] = false;
				$message['message'] = "取消停课失败";
				return $message;
			}
		}

		/*
		*俞鹏泽
		*获取某个学生的停课数据(停课是在停课时间内的)
		*/
		//参数一:学生的ID
		//参数二:表示时间,如果是null,则默认获取当前时间
		public function getStudentStopClass($studentID = null,$time = null){
			if(is_null($studentID)){
				return null;
			}
			if(is_null($time)){
				$time = getTime();
			}

			$inquiry = new Model('stopclass');
			$sql = "select tp_stopclass.stopclassID,tp_student.chinesename,
			tp_stopclass.stopStartTime,tp_stopclass.stopEndTime
			from tp_stopclass inner join tp_student on tp_student.ID=tp_stopclass.studentID
			and tp_stopclass.status=1 and stopStartTime<={$time} and stopEndTime>={$time}";
			$result = $inquiry->query($sql);

			return $result;
		}
	}
