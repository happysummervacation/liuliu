<?php
	class ContractBasicService extends Action{
		/*
		*俞鹏泽
		*学生进行签署合同的操作
		*/
		public function signContract($studentContractID = null){
			$message = array();
			if(is_null($studentContractID)){
				$message['status'] = false;
				$message['message'] = "签署合同失败";
				return $message;
			}

			$inquiry = new Model();
			$inquiry->startTrans();

			import("Home.Action.Contract.ContractBasicOperate");
			$conBasOp = new ContractBasicOperate();
			//设置签署合同
			$data['isSign'] = 1;
			$data['signTime'] = getTime();
			$contractResult = $conBasOp->updateStudentContract($ordercontractID,$data);
			//设置套餐的有效时间
			$data = array();
			$nowTime = getTime();
			$sql = "update tp_studentcontract,tp_orderpackage set `startTime`={$nowTime},
			`endTime`={$nowTime}+time*3600*24 where tp_studentcontract.orderpackageID=tp_orderpackage.orderpackageID
			 and ordercontractID={$studentContractID}";
			$orderPacResult = $inquiry->execute($sql);

			if($contractResult && $orderPacResult){
				$inquiry->commit();
				$message['status'] = true;
				$message['message'] = "签署合同成功";
				return $message;
			}else{
				$inquiry->rollback();
				$message['status'] = false;
				$message['message'] = "签署合同失败";
				return $message;
			}
		}
	}
 ?>
