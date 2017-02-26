<?php
	class OrderPackageBasicService extends Action{
		/*
		*俞鹏泽
		*通过站内支付的方式订购套餐
		*/
		/*过程:
		1.根据套餐ID获取套餐的价格以及相关信息
		2.根据学生ID来获取其账户的余额
		3.将套餐的价格与学生的账户余额进行比较
		4.如果学生账户余额不足就进行消息反馈.如果足就进行
		5.开始事务
		6.增加一份订购套餐信息
		7.添加一份订购关于该套餐的合同
		8.扣除相应的学生的金额
		9.记录一份学生金额操作记录                    ----------------------------->是否需要
		10.如果操作都成功就进行事务提交,反之,失败
		*/
		public function orderPakcageWithStatPay($packageID = null,$StudentID = null){
			$message = array();

			if(is_null($packageID) || is_null($StudentID)){
				$message['status'] = false;
				$message['message'] = "传入的必要参数有问题";
				return $message;
			}
			import("Home.Action.User.UserBasicOperate");
			import("Home.Action.Package.PackageBasicOperate");
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			import("Home.Action.Contract.ContractBasicOperate");
			import("Home.Action.Money.MoneyBasicOperate");
			$packageOp = new PackageBasicOperate();
			$userOp = new UserBasicOperate();
			$orderPackageOp = new OrderPackageBasicOperate();
			$contractOp = new ContractBasicOperate();
			$moneyOp = new MoneyBasicOperate();

			$field = array();
			array_push($field,"student_sum_money");

			$packageInfo = $packageOp->getPackageInfo($packageID);
			$userInfo = $userOp->getUserInfo("register",$StudentID,null,null,null,$field);
			if((int)$packageInfo[0]['package_money'] > $userInfo[0]['student_sum_money']){
				$message['status'] = false;
				$message['message'] = "账户余额不足";
				return $message;
			}

			$inquiry = new Model();
			$inquiry->startTrans();    //开始事务处理
			//增加一份要填写的套餐信息
			$orderPackageData = $this->createOrderPackageInfo($packageInfo[0],$StudentID);
			//将数据进行写入
			//这里需要将套餐的ID返回回来         ?????
			$orderPackageResult = $orderPackageOp->addOrderPakcageInfo($orderPackageData);    //如果返回的数据是新增的订购的套餐的主键
			//创建合同的数据
			$contractData = $this->createOrderPackageContract($orderPackageResult[''],$StudentID);
			//添加合同的信息
			$studentContractResult = $contractOp->addContract($contractData);
			//扣除学生的相应价格
			$moneyResult = $moneyOp->updateStudentMoney($StudentID,$packageInfo[0]['package_money']);
			//创建相应的学生金额
			$studentMoneyOpResult = true;        //暂时指定为true

			if(true){       //如果成功就进行
				$inquiry->commit();
				$message['status'] = true;
				$message['message'] = "购买套餐成功";
				return $message;
			}else{
				$inquiry->rollback();
				$message['status'] = false;
				$message['message'] = "购买套餐失败";
				return $message;
			}
		}

		public function orderPakcageWithAlipayPay($packageID = null,$StudentID = null){

		}

		/*
		*俞鹏泽
		*根据套餐的信息生成订购套餐的数据
		*/
		private function createOrderPackageInfo($packageInfo = null,$studentID = null){
			$data = array();
			if(is_null($packageInfo) || is_null($studentID)){
				return $data;
			}
			import("Home.Action.GlobalValue.GlobalValue");

			$data['studentID'] = $studentID;                          //1
			$data['category'] = $packageInfo['category'];             //2
			$data['classType'] = $packageInfo['class_type'];          //3
			$data['packageType'] = $packageInfo['package_type'];      //4
			$data['studentNumber'] = $packageInfo['student_number'];  //5
			$data['classNumber'] = $packageInfo['class_number'];      //6
			$data['teacherNation'] = $packageInfo['teacher_nation'];  //7
			$data['teacherType'] = $packageInfo['teacher_type'];      //8
			$data['time'] = $packageInfo['package_month'];            //9
			$data['packageName'] = $packageInfo['package_name'];      //10
			$data['packageContent'] = $packageInfo['package_content'];//11
			$data['packageMoney'] = $packageInfo['package_money'];    //12
			$data['haveClass'] = 0;                                   //13
			$data['otherClass'] = 0;                                  //14
			$data['status'] = 1;       //表示是有效的                   //15
			$data['startTime'] = GlobalValue::initOrderPackageTime;   //16
			$data['endTime'] = GlobalValue::initOrderPackageTime;     //17
			$data['isdelete'] = 0;                                    //18
			$data['packageCreateTime'] = getTime();                   //19
			$data['packageLastModify'] = getTime();                   //20

			return $data;
		}

		/*
		*俞鹏泽
		*生成关于订购套餐的合同信息
		*/
		private function createOrderPackageContract($orderpackageID = null,$StudentID = null){
			$data = array();
			if(is_null($orderPackageID) || is_null($StudentID)){
				return $data;
			}

			$data['orderpackageID'] = $orderpackageID;
			$data['order_party'] =	$StudentID;	 //订购方   即学生
			$data['isSign'] = 0;         //表示没有签署
			$data['create_time'] = getTime();
			$data['last_modify'] = getTime();

			return $data;
		}
	}
 ?>
