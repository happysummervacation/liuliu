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
		9.记录一份操作记录
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
			$packageOp = new PackageBasicOperate();
			$userOp = new UserBasicOperate();

			$field = array();
			array_push($field,"student_sum_money");

			$packageInfo = $packageOp->getPackageInfo($packageID);
			$userInfo = $userOp->getUserInfo("register",$StudentID,null,null,null,$field);
			if((int)$packageInfo[0]['package_money'] > $userInfo[0]['student_sum_money']){
				$message['status'] = false;
				$message['message'] = "账户余额不足";
				return $message;
			}
dump($packageInfo);
dump($userInfo);
			$inquiry = new Model();
			$inquiry->startTrans();    //开始事务处理
			//增加一份要填写的套餐信息

		}

		private function createOrderPackageInfo($packageInfo = null,$studentID = null){
			$data = array();
			if(is_null($packageInfo) || is_null($studentID)){
				return $data;
			}
			import("Home.Action.GlobalValue.GlobalValue");

			$data['studentID'] = $studentID;
			$data['category'] = $packageInfo['category'];
			$data['classType'] = $packageInfo['class_type'];
			$data['packageType'] = $packageInfo['package_type'];
			$data['studentNumber'] = $packageInfo['student_number'];
			$data['classNumber'] = $packageInfo['class_number'];
			$data['teacherNation'] = $packageInfo['teacher_nation'];
			$data['teacherType'] = $packageInfo['teacher_type'];
			$data['packageName'] = $packageInfo['package_name'];
			$data['packageContent'] = $packageInfo['package_content'];
			$data['packageMoney'] = $packageInfo['package_money'];
			$data['haveClass'] = 0;
			$data['otherClass'] = 0;
			$data['status'] = 1;       //表示是有效的
			$data['startTime'] = GlobalValue::initOrderPackageTime;
			$data['endTime'] = GlobalValue::initOrderPackageTime;
			$data['isdelete'] = 0;
			$data['packageCreateTime'] = getTime();
			$data['packageLastModify'] = getTime();

			return $data;
		}
	}
 ?>
