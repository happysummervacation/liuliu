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
			import("Home.Action.StudentAccount.StudentAccountOp");
			import("Home.Action.System.SystemBasicOperate");
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
			$systemBasOp = new SystemBasicOperate();
			$studentAccountOp = new StudentAccountOp();

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
			//这里需要将套餐的ID返回回来
			$orderPackageResult = $orderPackageOp->addOrderPakcageInfo($orderPackageData);    //如果返回的数据是新增的订购的套餐的主键

			//创建合同的数据
			$contractData = $this->createOrderPackageContract(
				$orderPackageResult['data'],$StudentID);
			//添加合同的信息
			$studentContractResult = $contractOp->addContract($contractData);
			//扣除学生的相应价格
			$packageInfo[0]['package_money'] = -$packageInfo[0]['package_money'];
			$moneyResult = $moneyOp->updateStudentMoney($StudentID,null,$packageInfo[0]['package_money']);
			// dump($moneyResult);
			// exit;
			//创建相应的学生金额
			$studentMoneyOpResult = true;        //暂时指定为true
/*
			//创建学生取消课程次数;
			$countResult = $systemBasOp->getSystemSet();
			// dump($countResult);
			// dump($countResult['cancelClassRate']);
			$canelcClassCount = $packageInfo['0']['class_number']/$countResult['cancelClassRate'];
*/
			//记录一份学生金额操作记录
			$dataOfAccountOpRecord = $this->createStudentAccountOp($packageInfo,$StudentID);
			$studentAccoutOpResult = $studentAccountOp
			->addStudentAccountOpRecord($dataOfAccountOpRecord);

			if($orderPackageResult['status'] && $studentContractResult['status'] &&
			$moneyResult['status'] && $studentAccoutOpResult['status'] ){       //如果成功就进行
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

		/*
		*俞鹏泽
		*通过alipay支付来实现课程的套餐的订购
		*/
		/*过程:
		*1.获取要订购的套餐的数据
		*2.跳转到指定alipay的页面,同时将数据一起带过去
		*/
		public function orderPakcageWithAlipayPay($packageID = null){
			$message = array();

			if(is_null($packageID)){
				$message['status'] = false;
				$message['message'] = "传入的必要参数有问题";
				return $message;
			}

			import("Home.Action.Package.PackageBasicOperate");
            $packageOp = new PackageBasicOperate();
			$packageInfo = $packageOp->getPackageInfo($packageID);
			$this->assign("packageInfo",$packageInfo[0]);    //传过去的二维数组的数据
			$this->display("Alipay:index");
		}

		/*
		*俞鹏泽
		*根据套餐的信息生成订购套餐的数据
		*/
		public function createOrderPackageInfo($packageInfo = null,$studentID = null){
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
			$data['time'] = $packageInfo['time'];                     //9
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
		private function createOrderPackageContract($orderPackageID = null,$StudentID = null){
			$data = array();

			if(is_null($orderPackageID) || is_null($StudentID)){
				return $data;
			}

			$data['orderpackageID'] = $orderPackageID;
			$data['order_party'] =	$StudentID;	 //订购方   即学生
			$data['isSign'] = 0;         //表示没有签署
			$data['create_time'] = getTime();
			$data['last_modify'] = getTime();
			return $data;
		}

		/*
		*俞鹏泽
		*生成关于学生账户操作记录的信息
		*/
		private function createStudentAccountOp($packageInfo = null,$StudentID){
			$data = array();
			if(is_null($packageInfo) || is_null($StudentID)){
				return $data;
			}
			$data['student_id'] = $StudentID;
			$data['ope_money'] = $packageInfo[0]['package_money'];
			$data['ope_time'] = getTime();
			$data['ope_type'] = 0;
			$data['remark'] = "你购买".$packageInfo['0']['packageName'].
			"套餐花了".-$packageInfo['0']['package_money']."元";

			return $data;
		}

		/*
		*俞鹏泽
		*获取某个学生订购的一对一套餐(课时类套餐还要获取还可以订购多少节课,如果是卡类套餐就不需要)
		*/
		/*流程:
		1.获取指定学生的订购的一对一的套餐
		2.进行数据判断是否是卡类套餐,如果不是就要获取学生使用该套餐订购课时数据,最后计算剩余可选课次数
		*/
		public function getStudentOneToOneOrderPackageInfo($StudentID = null){
			if(is_null($StudentID)){
				return null;
			}
            //获取学生的一对一类型套餐
			import("Home.Action.OrderPackage.OrderPackageBasicOperate");
			import("Home.Action.OrderPackage.OrderPackageFeatureService");
			import("Home.Action.OrderClass.OrderClassBasicOperate");
			$orderPackageOp = new OrderPackageBasicOperate();
			$orderClassOp = new OrderClassBasicOperate();

			$sql = "tp_orderpackage.isdelete=0 and tp_orderpackage.status=1
			and tp_orderpackage.classType=0 and studentID={$StudentID}";

			$orderPackageResult = $orderPackageOp->getOrderPackageInfoWithCondition($sql,
			"orderpackageID,classNumber,packageType,classType,otherClass,tp_packageconfig.packageName");
			//获取使用上面订购的套餐订购的还没有上的以及已经上的的学生的课程数
			$orderClassResult = array();
			foreach ($orderPackageResult as $key => $value) {
				//由于数据是一个个迭代下去的,所以套餐和套餐对应的课程剩余数据是相同
				$tem = array();
				$temresult = 0;
				$temresult = $orderClassOp->countStudentOneOrderClassNum($StudentID,$value['orderpackageID']);
				$tem['orderpackageID'] = $value['orderpackageID'];
				$tem['haveClass'] = $temresult;
				array_push($orderClassResult,$tem);
			}
			$result = OrderPackageFeatureService::dealOrderPackageAndOrderClass($orderPackageResult,$orderClassResult);

			return $result;
		}
	}
 ?>
