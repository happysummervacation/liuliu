<?php
	class SendClassBasicService extends Action{
		/*
		*俞鹏泽
		*往某个学生订购的套餐中赠送课时数
		*/
		public function sendClassToOrderPackage($orderPackageID = null,$sendNum = 0,$reason = "",$studentID = null){
			$message = array();
			if(is_null($orderPackageID) || is_null($studentID)){
				$message['status'] = false;
				$message['message'] = "缺乏必要的数据,赠送课时失败";
				return $message;
			}
			if($sendNum == 0){
				$message['status'] = false;
				$message['message'] = "赠送的课时数为零";
				return $message;
			}
			$inquiry = new Model();
			$inquiry->startTrans();

			$sendparty = $_SESSION['ID'];
			//判断赠送的套餐是课时类套餐还是卡类套餐
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			import("Home.Action.SendClass.SendClassBasicOperate");
			$orderPackageOp = new OrderPackageBasicOperate();
			$sendClassOp = new SendClassBasicOperate();

			$orderPackageResult = $orderPackageOp->getOneOrderPackageInfo($orderPackageID,"classType",2);

			if("0" == $orderPackageResult[0]['classType']
			 || 0 == $orderPackageResult[0]['classType']){   //表示是课时类的套餐
				 $data['sendParty'] = $sendparty;
				 $data['sendedParty'] = $studentID;
				 $data['sendNum'] = $sendNum;
				 $data['remark'] = $reason;
				 $data['sendTime'] = getTime();
				 $data['createTime'] = getTime();

				 $sendResult = $sendClassOp->addSendClassInfo($data);

				 $orderPacSql = "update tp_orderpackage set otherClass=otherClass+{$sendNum} where
				  orderPackageID={$orderPackageID}";
				 $orderPackageResult = $orderPackageOp->OrderPackageExecute($orderPacSql);

				 if($sendResult['status'] && $orderPackageResult>0){
					 $inquiry->commit();
					 $message['status'] = true;
	 				 $message['message'] = "赠送的课时成功";
	 				 return $message;
				 }else{
					 $inquiry->rollback();
					 $message['status'] = false;
	 				 $message['message'] = "赠送课时失败";
	 				 return $message;
				 }
			}else{					//表示是卡类的套餐

			}
		}
	}
 ?>
